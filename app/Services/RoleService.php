<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RoleService
{
    /**
     * Get all roles with their permissions.
     */
    public function getAll(): Collection
    {
        return Role::query()
            ->with('permissions')
            ->get();
    }

    /**
     * Create a role and assign its permissions.
     */
    public function create(array $data): Role
    {
        return DB::transaction(function () use ($data): Role {
            $permissionIds = $data['permission_ids'];

            unset($data['permission_ids']);

            $role = Role::create($data);

            $role->permissions()->sync($permissionIds);

            return $role->load('permissions');
        });
    }

    /**
     * Load a role with its permissions.
     */
    public function getByRole(Role $role): Role
    {
        return $role->load('permissions');
    }

    /**
     * Update a role and synchronize its permissions.
     */
    public function update(Role $role, array $data): Role
    {
        return DB::transaction(function () use ($role, $data): Role {
            if (array_key_exists('permission_ids', $data)) {
                $permissionIds = $data['permission_ids'];

                unset($data['permission_ids']);

                $role->permissions()->sync($permissionIds);
            }

            $role->update($data);

            return $role->load('permissions');
        });
    }

    /**
     * Delete a role.
     */
    public function delete(Role $role): bool
    {
        return (bool) $role->delete();
    }
}
