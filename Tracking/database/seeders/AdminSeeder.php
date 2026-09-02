<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@wgi.com'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create or update additional admin user
        User::updateOrCreate(
            ['email' => 'kevin@wgi.com'],
            [
                'name' => 'Kevin Pratama Bintang',
                'username' => 'kevin',
                'password' => Hash::make('kevin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
