<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CekKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cek_kendaraan')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            // 1. Matches ANT-001: B 1234 ABC, Budi Santoso
            [
                'tanggal' => Carbon::today(),
                'waktu_masuk' => '08:00:00',
                'waktu_keluar' => '08:30:00',
                'nomor_polisi' => 'B 1234 ABC',
                'jenis_kendaraan' => 'Truk', // Mapped from Finish Product
                'nama_driver' => 'Budi Santoso',
                'perusahaan' => 'PT Logistics One',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos',
                'catatan' => 'Kondisi kendaraan prima',
                'nama_petugas' => 'Bambang Petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 2. Matches ANT-002: B 5678 DEF, Joko Widodo
            [
                'tanggal' => Carbon::today(),
                'waktu_masuk' => '08:15:00',
                'waktu_keluar' => '08:45:00',
                'nomor_polisi' => 'B 5678 DEF',
                'jenis_kendaraan' => 'Tangki', // Mapped from Use Oil
                'nama_driver' => 'Bambang Prasetyo',
                'perusahaan' => 'PT Oil Trans',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos',
                'catatan' => 'Aman',
                'nama_petugas' => 'Bambang Petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 3. Matches ANT-003: B 9012 GHI, Siti Aminah
            [
                'tanggal' => Carbon::today(),
                'waktu_masuk' => '08:30:00',
                'waktu_keluar' => null, // Still inside
                'nomor_polisi' => 'B 9012 GHI',
                'jenis_kendaraan' => 'Truk', // Mapped from Raw Material
                'nama_driver' => 'Anisa Putri',
                'perusahaan' => 'CV Raw Material Jaya',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => false, // Expired KIR
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos Bersyarat',
                'catatan' => 'KIR Mati, tolong diperpanjang',
                'nama_petugas' => 'Agus Pemeriksa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 4. Matches ANT-004: B 3456 JKL, Rudi Hartono
            [
                'tanggal' => Carbon::today(),
                'waktu_masuk' => '08:45:00',
                'waktu_keluar' => null,
                'nomor_polisi' => 'B 3456 JKL',
                'jenis_kendaraan' => 'Mobil Box', // Mapped from Drum
                'nama_driver' => 'Deddy Setiawan',
                'perusahaan' => 'PT Drum Corp',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Kurang Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos Bersyarat',
                'catatan' => 'Ban depan kiri agak gundul',
                'nama_petugas' => 'Agus Pemeriksa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 5. Matches ANT-005: B 7890 MNO, Dewi Sartika
            [
                'tanggal' => Carbon::today(),
                'waktu_masuk' => '09:00:00',
                'waktu_keluar' => '09:10:00',
                'nomor_polisi' => 'B 7890 MNO',
                'jenis_kendaraan' => 'Truk', // Finish Product
                'nama_driver' => 'Fitri Handayani',
                'perusahaan' => 'PT Logistics One',
                'surat_jalan' => false, // Missing Doc
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Tidak Lolos',
                'catatan' => 'Surat Jalan tidak ada',
                'nama_petugas' => 'Bambang Petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 6. Matches ANT-006: D 1234 PQR, Ahmad Dahlan
            [
                'tanggal' => Carbon::today(),
                'waktu_masuk' => '09:15:00',
                'waktu_keluar' => null,
                'nomor_polisi' => 'D 1234 PQR',
                'jenis_kendaraan' => 'Tangki', // Use Oil
                'nama_driver' => 'Guntur Saputra',
                'perusahaan' => 'PT Oil Trans',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos',
                'catatan' => '-',
                'nama_petugas' => 'Agus Pemeriksa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 7. Matches ANT-007: F 5678 STU, Kartini (Yesterday)
            [
                'tanggal' => Carbon::yesterday(),
                'waktu_masuk' => '14:00:00',
                'waktu_keluar' => '15:00:00',
                'nomor_polisi' => 'F 5678 STU',
                'jenis_kendaraan' => 'Truk', // Raw Material
                'nama_driver' => 'Indah Lestari',
                'perusahaan' => 'CV Raw Material Jaya',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos',
                'catatan' => '-',
                'nama_petugas' => 'Bambang Petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 8. Matches ANT-008: A 9012 VWX, Hasyim Asyari (Yesterday)
            [
                'tanggal' => Carbon::yesterday(),
                'waktu_masuk' => '14:30:00',
                'waktu_keluar' => '15:30:00',
                'nomor_polisi' => 'A 9012 VWX',
                'jenis_kendaraan' => 'Mobil Box', // Drum
                'nama_driver' => 'Joko Susilo',
                'perusahaan' => 'PT Drum Corp',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos',
                'catatan' => '-',
                'nama_petugas' => 'Agus Pemeriksa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 9. Matches ANT-009: H 3456 YZ, Cut Nyak Dien (Yesterday)
            [
                'tanggal' => Carbon::yesterday(),
                'waktu_masuk' => '15:00:00',
                'waktu_keluar' => null,
                'nomor_polisi' => 'H 3456 YZ',
                'jenis_kendaraan' => 'Truk', // Finish Product
                'nama_driver' => 'Kurniawati',
                'perusahaan' => 'PT Logistics One',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Tidak Layak',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Tidak Lolos',
                'catatan' => 'Ban pecah',
                'nama_petugas' => 'Bambang Petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 10. Matches ANT-010: L 7890 AB, Pattimura (Yesterday)
            [
                'tanggal' => Carbon::yesterday(),
                'waktu_masuk' => '15:30:00',
                'waktu_keluar' => '16:00:00',
                'nomor_polisi' => 'L 7890 AB',
                'jenis_kendaraan' => 'Tangki', // Use Oil
                'nama_driver' => 'Lukman Hakim',
                'perusahaan' => 'PT Oil Trans',
                'surat_jalan' => true,
                'stnk_valid' => true,
                'sim_valid' => true,
                'kir_valid' => true,
                'kondisi_ban' => 'Baik',
                'kondisi_lampu' => 'Baik',
                'kondisi_rem' => 'Baik',
                'kondisi_lampu_sen' => 'Baik',
                'kaca_spion_lengkap' => true,
                'hasil_pemeriksaan' => 'Lolos',
                'catatan' => '-',
                'nama_petugas' => 'Agus Pemeriksa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('cek_kendaraan')->insert($data);
    }
}
