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
        // Create default admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@lensajember.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create sample regular user
        User::create([
            'name' => 'User Demo',
            'email' => 'user@lensajember.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
