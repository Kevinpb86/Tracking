<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AntrianPos1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('antrian_pos1')->truncate();

        $data = [
            [
                'no_antrian' => 'ANT-001',
                'nomor_polisi' => 'B 1234 ABC',
                'nama_driver' => 'Budi Santoso',
                'jenis_antrian' => 'Finish Product',
                'tujuan' => 'Gudang A',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-002',
                'nomor_polisi' => 'B 5678 DEF',
                'nama_driver' => 'Joko Widodo',
                'jenis_antrian' => 'Use Oil',
                'tujuan' => 'Gudang B',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:15:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-003',
                'nomor_polisi' => 'B 9012 GHI',
                'nama_driver' => 'Siti Aminah',
                'jenis_antrian' => 'Raw Material',
                'tujuan' => 'Loading Dock',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:30:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-004',
                'nomor_polisi' => 'B 3456 JKL',
                'nama_driver' => 'Rudi Hartono',
                'jenis_antrian' => 'Drum',
                'tujuan' => 'Gudang C',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '08:45:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-005',
                'nomor_polisi' => 'B 7890 MNO',
                'nama_driver' => 'Dewi Sartika',
                'jenis_antrian' => 'Finish Product',
                'tujuan' => 'Gudang A',
                'emr' => 'Critical',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '09:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-006',
                'nomor_polisi' => 'D 1234 PQR',
                'nama_driver' => 'Ahmad Dahlan',
                'jenis_antrian' => 'Use Oil',
                'tujuan' => 'Gudang B',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::today(),
                'jam_diizinkan_masuk' => '09:15:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-007',
                'nomor_polisi' => 'F 5678 STU',
                'nama_driver' => 'Kartini',
                'jenis_antrian' => 'Raw Material',
                'tujuan' => 'Loading Dock',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::yesterday(),
                'jam_diizinkan_masuk' => '14:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-008',
                'nomor_polisi' => 'A 9012 VWX',
                'nama_driver' => 'Hasyim Asyari',
                'jenis_antrian' => 'Drum',
                'tujuan' => 'Gudang C',
                'emr' => 'Normal',
                'tgl_antrian' => Carbon::yesterday(),
                'jam_diizinkan_masuk' => '14:30:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-009',
                'nomor_polisi' => 'H 3456 YZ',
                'nama_driver' => 'Cut Nyak Dien',
                'jenis_antrian' => 'Finish Product',
                'tujuan' => 'Gudang A',
                'emr' => 'Urgent',
                'tgl_antrian' => Carbon::yesterday(),
                'jam_diizinkan_masuk' => '15:00:00',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_antrian' => 'ANT-010',
                'nomor_polisi' => 'L 7890 AB',
                'nama_driver' => 'Pattimura',
                'jenis_antrian' => 'Use Oil',
                'tujuan' => 'Gudang B',
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
