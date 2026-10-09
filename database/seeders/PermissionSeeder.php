<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('permissions')->upsert([
            [
                'name' => 'View Roles',
                'slug' => 'roles.view',
                'group_name' => 'Roles',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Create Roles',
                'slug' => 'roles.create',
                'group_name' => 'Roles',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Update Roles',
                'slug' => 'roles.update',
                'group_name' => 'Roles',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Delete Roles',
                'slug' => 'roles.delete',
                'group_name' => 'Roles',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ], ['slug'], ['name', 'group_name', 'updated_at']);
    }
}
