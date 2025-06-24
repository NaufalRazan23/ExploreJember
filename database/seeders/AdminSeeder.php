<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user (from setup guide)
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create sample regular user (from setup guide)
        User::firstOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'User Demo',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // Keep existing users if they exist
        User::firstOrCreate(
            ['email' => 'admin@lensajember.com'],
            [
                'name' => 'Admin Lensa',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@lensajember.com'],
            [
                'name' => 'User Lensa',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}
