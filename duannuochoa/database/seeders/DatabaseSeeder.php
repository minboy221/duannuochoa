<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Roles
        \Illuminate\Support\Facades\DB::table('roles')->updateOrInsert(
            ['role_id' => 1], ['role_name' => 'Admin']
        );
        \Illuminate\Support\Facades\DB::table('roles')->updateOrInsert(
            ['role_id' => 2], ['role_name' => 'User']
        );

        // Seed Admin Account
        \Illuminate\Support\Facades\DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'admin',
                'full_name' => 'Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
            ]
        );
    }
}
