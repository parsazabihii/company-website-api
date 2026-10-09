<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class PermissionService
{
    /**
     * Get all permissions.
     */
    public function getAll(): Collection
    {
        return Permission::query()->get();
    }

    /**
     * Create a permission.
     */
    public function create(array $data): Permission
    {
        return Permission::create($data);
    }

    /**
     * Get the given permission.
     */
    public function getByPermission(Permission $permission): Permission
    {
        return $permission;
    }

    /**
     * Update a permission.
     */
    public function update(
        Permission $permission,
        array $data
    ): Permission {
        $permission->update($data);

        return $permission->refresh();
    }

    /**
     * Delete a permission.
     */
    public function delete(Permission $permission): bool
    {
        return (bool) $permission->delete();
    }
}
