<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('roles')->upsert([
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ], ['slug'], ['name', 'updated_at']);


        $adminRole = DB::table('roles')
            ->where('slug', 'admin')
            ->first();


        $permissions = DB::table('permissions')
            ->pluck('id');


        $rolePermissions = [];

        foreach ($permissions as $permissionId) {
            $rolePermissions[] = [
                'role_id' => $adminRole->id,
                'permission_id' => $permissionId,
            ];
        }


        DB::table('role_permissions')->upsert(
            $rolePermissions,
            ['role_id', 'permission_id']
        );
    }
}
