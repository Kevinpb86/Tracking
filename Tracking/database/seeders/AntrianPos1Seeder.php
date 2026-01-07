<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AntrianPos1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('antrian_pos1')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'no_antrian' => 'ANT-001',
                'nomor_polisi' => 'B 1234 ABC',
                'nama_driver' => 'Budi Santoso',
                'jenis_antrian' => 'Finish Product',
                'tujuan' => 'Gate 1',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-002',
                'nomor_polisi' => 'B 5678 DEF',
                'nama_driver' => 'Bambang Prasetyo',
                'jenis_antrian' => 'Use Oil',
                'tujuan' => 'Gate 2',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:15:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-003',
                'nomor_polisi' => 'B 9012 GHI',
                'nama_driver' => 'Anisa Putri',
                'jenis_antrian' => 'Raw Material',
                'tujuan' => 'Gate 3',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:30:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-004',
                'nomor_polisi' => 'B 3456 JKL',
                'nama_driver' => 'Deddy Setiawan',
                'jenis_antrian' => 'Drum',
                'tujuan' => 'Gate 3',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:45:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-005',
                'nomor_polisi' => 'B 7890 MNO',
                'nama_driver' => 'Fitri Handayani',
                'jenis_antrian' => 'Finish Product',
                'tujuan' => 'Gate 1',
                'emr' => 'Critical',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '09:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-006',
                'nomor_polisi' => 'D 1234 PQR',
                'nama_driver' => 'Guntur Saputra',
                'jenis_antrian' => 'Use Oil',
                'tujuan' => 'Gate 2',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '09:15:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-007',
                'nomor_polisi' => 'F 5678 STU',
                'nama_driver' => 'Indah Lestari',
                'jenis_antrian' => 'Raw Material',
                'tujuan' => 'Gate 3',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::yesterday(),
                'jam_diizinkan_masuk' => '14:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-008',
                'nomor_polisi' => 'A 9012 VWX',
                'nama_driver' => 'Joko Susilo',
                'jenis_antrian' => 'Drum',
                'tujuan' => 'Gate 3',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::yesterday(),
                'jam_diizinkan_masuk' => '14:30:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-009',
                'nomor_polisi' => 'H 3456 YZ',
                'nama_driver' => 'Kurniawati',
                'jenis_antrian' => 'Finish Product',
                'tujuan' => 'Gate 1',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::yesterday(),
                'jam_diizinkan_masuk' => '15:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-010',
                'nomor_polisi' => 'L 7890 AB',
                'nama_driver' => 'Lukman Hakim',
                'jenis_antrian' => 'Use Oil',
                'tujuan' => 'Gate 2',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::yesterday(),
                'jam_diizinkan_masuk' => '15:30:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('antrian_pos1')->insert($data);
    }
}
