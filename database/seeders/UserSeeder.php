<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Premier administrateur
        $admin1 = User::create([
            'name' => 'Admin Test',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
        $admin1->assignRole('admin');

        // Deuxième administrateur
        $admin2 = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);
        $admin2->assignRole('admin');
    }
} 