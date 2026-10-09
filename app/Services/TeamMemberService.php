<?php

namespace App\Services;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class TeamMemberService
{
    public function list(): Collection
    {
        return TeamMember::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();
    }

    public function find(int $id): TeamMember
    {
        return TeamMember::query()->findOrFail($id);
    }

    public function create(array $data): TeamMember
    {
        $newImagePath = null;

        try {
            if (($data['image'] ?? null) instanceof UploadedFile) {
                $newImagePath = $this->storeImage($data['image']);
                $data['image'] = $newImagePath;
            }

            return TeamMember::query()->create($data);
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $exception;
        }
    }

    public function update(int $id, array $data): TeamMember
    {
        $teamMember = TeamMember::query()->findOrFail($id);

        $newImagePath = null;
        $oldImagePath = null;

        try {
            if (($data['image'] ?? null) instanceof UploadedFile) {
                $newImagePath = $this->storeImage($data['image']);
                $oldImagePath = $teamMember->image;

                $data['image'] = $newImagePath;
            }

            $updated = $teamMember->update($data);

            if (!$updated) {
                throw new RuntimeException(
                    'Failed to update the team member.'
                );
            }
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $exception;
        }

        if ($oldImagePath !== null) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return $teamMember->refresh();
    }

    public function delete(int $id): bool
    {
        $teamMember = TeamMember::query()->findOrFail($id);

        $imagePath = $teamMember->image;

        $deleted = $teamMember->delete();

        if (!$deleted) {
            throw new RuntimeException(
                'Failed to delete the team member.'
            );
        }

        if ($imagePath !== null) {
            Storage::disk('public')->delete($imagePath);
        }

        return true;
    }

    private function storeImage(UploadedFile $image): string
    {
        $path = $image->store('team-members', 'public');

        if ($path === false) {
            throw new RuntimeException(
                'Failed to store the team member image.'
            );
        }

        return $path;
    }
}
