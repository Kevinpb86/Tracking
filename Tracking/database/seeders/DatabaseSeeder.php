<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            AntrianPos1Seeder::class,
            DoItemSeeder::class,
            CekKendaraanSeeder::class,
            HSESeeder::class,
            CekBarangSeeder::class,
            TrackingSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
