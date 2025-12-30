<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Safe conditions
            [
                'tanggal' => Carbon::today()->subDays(2)->format('Y-m-d'),
                'waktu' => '08:00:00',
                'nama_petugas' => 'Budi Santoso',
                'lokasi' => 'Area Bongkar Muat',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Semua pekerja menggunakan APD lengkap',
                'tindak_lanjut' => 'Pertahankan',
                'penanggung_jawab' => 'Andi Wijaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Unsafe condition example
            [
                'tanggal' => Carbon::today()->subDays(1)->format('Y-m-d'),
                'waktu' => '10:30:00',
                'nama_petugas' => 'Siti Aminah',
                'lokasi' => 'Gudang Penyimpanan',
                'kondisi_apd' => 'Tidak Lengkap',
                'temuan' => 'Satu pekerja tidak menggunakan helm safety',
                'tindak_lanjut' => 'Ditegur dan diminta menggunakan helm',
                'penanggung_jawab' => 'Budi Santoso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // More data
            [
                'tanggal' => Carbon::today()->format('Y-m-d'),
                'waktu' => '09:15:00',
                'nama_petugas' => 'Rudi Hartono',
                'lokasi' => 'Pos Security Utama',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Pemeriksaan rutin berjalan lancar',
                'tindak_lanjut' => '-',
                'penanggung_jawab' => 'Rudi Hartono',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::today()->subDays(3)->format('Y-m-d'),
                'waktu' => '14:20:00',
                'nama_petugas' => 'Dewi Sartika',
                'lokasi' => 'Area Parkir Truk',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Rambu keselamatan terlihat jelas',
                'tindak_lanjut' => 'Lanjutkan monitoring',
                'penanggung_jawab' => 'Andi Wijaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::today()->subDays(1)->format('Y-m-d'),
                'waktu' => '16:00:00',
                'nama_petugas' => 'Budi Santoso',
                'lokasi' => 'Workshop',
                'kondisi_apd' => 'Tidak Lengkap',
                'temuan' => 'Sarung tangan safety sudah aus',
                'tindak_lanjut' => 'Segera ganti sarung tangan baru',
                'penanggung_jawab' => 'Siti Aminah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('hse')->insert($data);
    }
}
