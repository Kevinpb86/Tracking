<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'testuser'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['username' => 'pos1'],
            [
                'name' => 'POS 1',
                'email' => 'pos1@tracking.com',
                'password' => Hash::make('12345678'),
            ]
        );

        User::firstOrCreate(
            ['username' => 'pos2'],
            [
                'name' => 'POS 2',
                'email' => 'pos2@tracking.com',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}
