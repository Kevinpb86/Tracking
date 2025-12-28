<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hse;
use Carbon\Carbon;

class HseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hseData = [
            [
                'tanggal' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'waktu' => '08:30:00',
                'nama_petugas' => 'Ahmad Fauzi',
                'lokasi' => 'Area Loading Bay 1',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Semua pekerja menggunakan APD lengkap, area kerja bersih dan terorganisir',
                'tindak_lanjut' => 'Pertahankan standar keselamatan',
                'penanggung_jawab' => 'Supervisor Area 1'
            ],
            [
                'tanggal' => Carbon::now()->subDays(12)->format('Y-m-d'),
                'waktu' => '10:15:00',
                'nama_petugas' => 'Siti Nurhaliza',
                'lokasi' => 'Gudang Penyimpanan B',
                'kondisi_apd' => 'Tidak Lengkap',
                'temuan' => 'Ditemukan 2 pekerja tidak menggunakan safety shoes',
                'tindak_lanjut' => 'Memberikan peringatan dan mewajibkan penggunaan safety shoes',
                'penanggung_jawab' => 'Kepala Gudang B'
            ],
            [
                'tanggal' => Carbon::now()->subDays(18)->format('Y-m-d'),
                'waktu' => '14:20:00',
                'nama_petugas' => 'Budi Santoso',
                'lokasi' => 'Area Unloading Truck',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Proses bongkar muat berjalan sesuai SOP, tidak ada temuan khusus',
                'tindak_lanjut' => 'Monitoring rutin tetap dilakukan',
                'penanggung_jawab' => 'Koordinator Logistik'
            ],
            [
                'tanggal' => Carbon::now()->subDays(25)->format('Y-m-d'),
                'waktu' => '09:45:00',
                'nama_petugas' => 'Dewi Kusuma',
                'lokasi' => 'Workshop Maintenance',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Peralatan safety dalam kondisi baik, alat pemadam kebakaran aktif',
                'tindak_lanjut' => 'Jadwal pengecekan rutin bulan depan',
                'penanggung_jawab' => 'Manajer Maintenance'
            ],
            [
                'tanggal' => Carbon::now()->subDays(32)->format('Y-m-d'),
                'waktu' => '11:30:00',
                'nama_petugas' => 'Rudi Hartono',
                'lokasi' => 'Area Parkir Kendaraan',
                'kondisi_apd' => 'Tidak Ada',
                'temuan' => 'Petugas keamanan tidak menggunakan APD saat bertugas',
                'tindak_lanjut' => 'Sosialisasi pentingnya APD dan penyediaan APD lengkap',
                'penanggung_jawab' => 'Kepala Keamanan'
            ],
            [
                'tanggal' => Carbon::now()->subDays(45)->format('Y-m-d'),
                'waktu' => '13:15:00',
                'nama_petugas' => 'Maya Puspita',
                'lokasi' => 'Kantor Administrasi',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Jalur evakuasi jelas, rambu K3 terpasang dengan baik',
                'tindak_lanjut' => 'Simulasi evakuasi terjadwal bulan depan',
                'penanggung_jawab' => 'Manager HSE'
            ],
            [
                'tanggal' => Carbon::now()->subDays(52)->format('Y-m-d'),
                'waktu' => '15:40:00',
                'nama_petugas' => 'Eko Prasetyo',
                'lokasi' => 'Area Loading Bay 2',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Forklift operator menggunakan APD sesuai standar, area bersih dari tumpahan',
                'tindak_lanjut' => 'Lanjutkan monitoring harian',
                'penanggung_jawab' => 'Supervisor Area 2'
            ],
            [
                'tanggal' => Carbon::now()->subDays(60)->format('Y-m-d'),
                'waktu' => '08:00:00',
                'nama_petugas' => 'Rina Marlina',
                'lokasi' => 'Pos Keamanan Utama',
                'kondisi_apd' => 'Tidak Lengkap',
                'temuan' => 'Helm safety tidak digunakan saat inspeksi area outdoor',
                'tindak_lanjut' => 'Penyediaan APD tambahan di pos keamanan',
                'penanggung_jawab' => 'Koordinator Keamanan'
            ],
            [
                'tanggal' => Carbon::now()->subDays(75)->format('Y-m-d'),
                'waktu' => '16:20:00',
                'nama_petugas' => 'Agus Supriyanto',
                'lokasi' => 'Area Distribusi Produk',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Stacking barang sesuai prosedur, tidak ada barang blocking jalan',
                'tindak_lanjut' => 'Pertahankan kerapihan dan ketertiban',
                'penanggung_jawab' => 'Supervisor Distribusi'
            ],
            [
                'tanggal' => Carbon::now()->subDays(85)->format('Y-m-d'),
                'waktu' => '12:10:00',
                'nama_petugas' => 'Linda Sari',
                'lokasi' => 'Chemical Storage Area',
                'kondisi_apd' => 'Lengkap',
                'temuan' => 'Penyimpanan bahan kimia sesuai MSDS, ventilasi baik, APD khusus tersedia',
                'tindak_lanjut' => 'Audit tahunan chemical safety terjadwal',
                'penanggung_jawab' => 'Safety Officer'
            ],
        ];

        foreach ($hseData as $data) {
            Hse::create($data);
        }

        $this->command->info('10 HSE dummy data berhasil ditambahkan!');
    }
}
