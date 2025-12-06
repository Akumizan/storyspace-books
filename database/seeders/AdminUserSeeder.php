<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@storyspace.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);
        
        echo "================================\n";
        echo "ADMIN USER CREATED!\n";
        echo "Email: admin@storyspace.com\n";
        echo "Password: password123\n";
        echo "================================\n";
    }
}