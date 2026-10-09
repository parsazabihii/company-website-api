<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class MenuService
{
    /**
     * Get all menus as a nested tree.
     *
     * @return EloquentCollection<int, Menu>
     */
    public function tree(): EloquentCollection
    {
        $menus = Menu::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $groupedMenus = $menus->groupBy(
            static fn (Menu $menu): int => $menu->parent_id ?? 0
        );

        return $this->buildTree(
            groupedMenus: $groupedMenus,
            parentKey: 0,
        );
    }

    public function find(int $id): Menu
    {
        return Menu::query()->findOrFail($id);
    }

    public function create(array $data): Menu
    {
        return Menu::query()->create($data);
    }

    public function update(int $id, array $data): Menu
    {
        $menu = Menu::query()->findOrFail($id);

        if (array_key_exists('parent_id', $data)) {
            $this->ensureValidParent(
                menu: $menu,
                parentId: $data['parent_id'],
            );
        }

        $updated = $menu->update($data);

        if (! $updated) {
            throw new RuntimeException('Failed to update the menu.');
        }

        return $menu->refresh();
    }

    public function delete(int $id): bool
    {
        $menu = Menu::query()->findOrFail($id);

        if ($menu->children()->exists()) {
            throw ValidationException::withMessages([
                'menu' => [
                    'A menu with child items cannot be deleted.',
                ],
            ]);
        }

        $deleted = $menu->delete();

        if (! $deleted) {
            throw new RuntimeException('Failed to delete the menu.');
        }

        return true;
    }

    /**
     * @return EloquentCollection<int, Menu>
     */
    private function buildTree(
        SupportCollection $groupedMenus,
        int $parentKey,
    ): EloquentCollection {
        /** @var EloquentCollection<int, Menu> $children */
        $children = $groupedMenus->get(
            $parentKey,
            new EloquentCollection()
        );

        foreach ($children as $child) {
            $child->setRelation(
                'children',
                $this->buildTree(
                    groupedMenus: $groupedMenus,
                    parentKey: $child->id,
                )
            );
        }

        return $children;
    }

    private function ensureValidParent(
        Menu $menu,
        ?int $parentId,
    ): void {
        if ($parentId === null) {
            return;
        }

        if ($parentId === $menu->id) {
            throw ValidationException::withMessages([
                'parent_id' => [
                    'A menu cannot be its own parent.',
                ],
            ]);
        }

        $currentMenu = Menu::query()->findOrFail($parentId);
        $visitedIds = [];

        while ($currentMenu !== null) {
            if ($currentMenu->id === $menu->id) {
                throw ValidationException::withMessages([
                    'parent_id' => [
                        'A menu cannot be moved under one of its descendants.',
                    ],
                ]);
            }

            if (isset($visitedIds[$currentMenu->id])) {
                throw ValidationException::withMessages([
                    'parent_id' => [
                        'The menu hierarchy contains a circular relationship.',
                    ],
                ]);
            }

            $visitedIds[$currentMenu->id] = true;

            if ($currentMenu->parent_id === null) {
                break;
            }

            $currentMenu = Menu::query()
                ->findOrFail($currentMenu->parent_id);
        }
    }
}
