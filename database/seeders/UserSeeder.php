<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = DB::table('roles')
            ->where('slug', 'admin')
            ->first();

        User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'role_id' => $adminRole->id,
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
    }
}
