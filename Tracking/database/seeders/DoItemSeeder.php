<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('do_items')->truncate();
        Schema::enableForeignKeyConstraints();
        $doItems = [
            [
                'vbeln' => '8000123456',
                'posnr' => '000010',
                'matnr' => 'OLI-SAE-40',
                'arktx' => 'Oli Mesin SAE 40 - Evalube Premium',
                'ifimg' => 1000.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123456',
                'posnr' => '000020',
                'matnr' => 'OLI-SAE-50',
                'arktx' => 'Oli Mesin SAE 50 - Evalube Heavy Duty',
                'ifimg' => 750.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123457',
                'posnr' => '000010',
                'matnr' => 'OLI-HYD-68',
                'arktx' => 'Oli Hidrolik 68 - Evalube Industrial',
                'ifimg' => 500.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123457',
                'posnr' => '000020',
                'matnr' => 'GRS-MP3',
                'arktx' => 'Grease MP3 - Evalube Multi Purpose',
                'ifimg' => 200.00,
                'vrkme' => 'KG',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123458',
                'posnr' => '000010',
                'matnr' => 'OLI-GEAR-220',
                'arktx' => 'Oli Gear 220 - Evalube Gear Oil',
                'ifimg' => 600.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123459',
                'posnr' => '000010',
                'matnr' => 'OLI-TURBO-15W40',
                'arktx' => 'Oli Turbo Diesel 15W-40 - Evalube Turbo',
                'ifimg' => 1200.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123460',
                'posnr' => '000010',
                'matnr' => 'OLI-ATF-DIII',
                'arktx' => 'Automatic Transmission Fluid DIII - Evalube ATF',
                'ifimg' => 400.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123461',
                'posnr' => '000010',
                'matnr' => 'OLI-COMP-46',
                'arktx' => 'Compressor Oil 46 - Evalube Compressor',
                'ifimg' => 300.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123462',
                'posnr' => '000010',
                'matnr' => 'OLI-BRAKE-DOT4',
                'arktx' => 'Brake Fluid DOT 4 - Evalube Brake',
                'ifimg' => 150.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'vbeln' => '8000123463',
                'posnr' => '000010',
                'matnr' => 'COOL-RADIATOR',
                'arktx' => 'Coolant Radiator - Evalube Coolant',
                'ifimg' => 800.00,
                'vrkme' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('do_items')->insert($doItems);
    }
}
