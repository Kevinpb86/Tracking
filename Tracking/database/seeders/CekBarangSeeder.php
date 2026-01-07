<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\AntrianPos1;
use App\Models\DoItem;

class CekBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cek_barang')->truncate();
        Schema::enableForeignKeyConstraints();
        // Ambil data dari antrian_pos1
        $antrianList = AntrianPos1::limit(10)->get();

        // Ambil data dari do_items
        $doItems = DoItem::limit(10)->get();

        // Jika tidak ada data antrian atau do_items, buat data dummy
        if ($antrianList->isEmpty()) {
            echo "Warning: Tidak ada data di tabel antrian_pos1. Silakan seed antrian terlebih dahulu.\n";
            return;
        }

        if ($doItems->isEmpty()) {
            echo "Warning: Tidak ada data di tabel do_items. Silakan seed do_items terlebih dahulu.\n";
            return;
        }

        $cekBarangData = [];
        $pemeriksa = ['Ahmad Fauzi', 'Budi Santoso', 'Citra Dewi', 'Dedi Kurniawan', 'Eka Putri'];
        $jenisBarang = [
            'Oli Mesin SAE 40',
            'Oli Mesin SAE 50',
            'Oli Hidrolik 68',
            'Grease MP3',
            'Oli Gear 220',
            'Oli Turbo Diesel',
            'ATF Fluid',
            'Compressor Oil',
            'Brake Fluid',
            'Coolant Radiator'
        ];

        $satuan = ['L', 'KG', 'Drum', 'Pail'];
        $jenisKendaraan = ['Truck Tangki', 'Truck Biasa', 'Lainnya'];
        $statusAkhir = ['Lolos', 'Lolos', 'Lolos', 'Lolos', 'Ditahan', 'Lolos', 'Lolos', 'Lolos', 'Ditolak', 'Lolos'];

        for ($i = 0; $i < 10; $i++) {
            $antrian = $antrianList[$i] ?? $antrianList[0];
            $doItem = $doItems[$i] ?? $doItems[0];

            $jenis_kendaraan = $jenisKendaraan[array_rand($jenisKendaraan)];
            $status = $statusAkhir[$i];

            // Tentukan kondisi berdasarkan status
            $kondisi_kemasan = $status === 'Ditolak' ? 'Rusak' : ($status === 'Ditahan' ? 'Basah' : 'Baik');
            $kesesuaian_jumlah = $status === 'Ditolak' ? 'Kurang' : 'Sesuai';
            $kelengkapan_dokumen = $status === 'Ditahan' ? 'Tidak Lengkap' : 'Lengkap';

            // Data kebocoran untuk truck tangki
            $kebocoran_tangki = null;
            $kondisi_seal_tangki = null;
            $lokasi_kebocoran = null;

            if ($jenis_kendaraan === 'Truck Tangki') {
                if ($status === 'Ditolak') {
                    $kebocoran_tangki = 'Ada Kebocoran Besar';
                    $kondisi_seal_tangki = 'Rusak';
                    $lokasi_kebocoran = 'Bagian bawah tangki, sambungan pipa';
                } elseif ($status === 'Ditahan') {
                    $kebocoran_tangki = 'Ada Kebocoran Kecil';
                    $kondisi_seal_tangki = 'Rusak';
                    $lokasi_kebocoran = 'Seal valve utama';
                } else {
                    $kebocoran_tangki = 'Tidak Ada';
                    $kondisi_seal_tangki = 'Baik';
                }
            }

            $catatan = null;
            if ($status === 'Ditolak') {
                $catatan = 'Barang ditolak karena kemasan rusak dan terdapat kebocoran besar pada tangki. Tidak layak untuk distribusi.';
            } elseif ($status === 'Ditahan') {
                $catatan = 'Barang ditahan sementara untuk perbaikan dokumen dan pengecekan ulang seal tangki.';
            }

            $cekBarangData[] = [
                'tanggal' => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d'),
                'waktu' => sprintf('%02d:%02d:00', rand(7, 17), rand(0, 59)),
                'nama_pemeriksa' => $pemeriksa[array_rand($pemeriksa)],
                'nomor_polisi' => $antrian->nomor_polisi,
                'nama_pengemudi' => $antrian->nama_driver,
                'nomor_do' => $doItem->vbeln,
                'jenis_barang' => $jenisBarang[$i],
                'jumlah_barang' => rand(100, 2000),
                'satuan' => $satuan[array_rand($satuan)],
                'kondisi_kemasan' => $kondisi_kemasan,
                'kesesuaian_jumlah' => $kesesuaian_jumlah,
                'kelengkapan_dokumen' => $kelengkapan_dokumen,
                'jenis_kendaraan' => $jenis_kendaraan,
                'kebocoran_tangki' => $kebocoran_tangki,
                'kondisi_seal_tangki' => $kondisi_seal_tangki,
                'lokasi_kebocoran' => $lokasi_kebocoran,
                'catatan' => $catatan,
                'status_akhir' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('cek_barang')->insert($cekBarangData);

        echo "✓ Berhasil membuat 10 data Cek Barang dengan referensi dari antrian_pos1 dan do_items\n";
    }
}
