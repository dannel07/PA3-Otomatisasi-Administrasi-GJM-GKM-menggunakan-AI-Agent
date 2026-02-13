<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // GKM Reviewer
        User::create([
            'name' => 'GKM Reviewer',
            'username' => 'gkmreviewer',
            'email' => 'gkm@example.com',
            'password' => Hash::make('password'),
            'role' => 'gkm_reviewer',
            'is_active' => true,
        ]);

        // GJM Reviewer
        User::create([
            'name' => 'GJM Reviewer',
            'username' => 'gjmreviewer',
            'email' => 'gjm@example.com',
            'password' => Hash::make('password'),
            'role' => 'gjm_reviewer',
            'is_active' => true,
        ]);
    }
}
