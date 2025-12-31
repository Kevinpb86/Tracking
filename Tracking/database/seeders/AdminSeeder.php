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
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@wgi.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        // Create additional admin user (optional)
        User::create([
            'name' => 'Kevin Pratama Bintang',
            'username' => 'kevin',
            'email' => 'kevin@wgi.com',
            'password' => Hash::make('kevin123'),
            'email_verified_at' => now(),
        ]);
    }
}
