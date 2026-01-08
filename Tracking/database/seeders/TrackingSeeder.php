<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\AntrianPos1;
use App\Models\CekKendaraan;
use App\Models\Hse;
use App\Models\CekBarang;
use App\Models\DoItem;

class TrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tracking')->truncate();
        Schema::enableForeignKeyConstraints();

        // Get matching records from all tables (assuming they were seeded in order 1-10)
        $antrians = AntrianPos1::orderBy('id')->take(10)->get();
        $cekKendaraans = CekKendaraan::orderBy('id')->take(10)->get();
        $hses = Hse::orderBy('id')->take(10)->get();
        $cekBarangs = CekBarang::orderBy('id')->take(10)->get();
        $doItems = DoItem::orderBy('id')->take(10)->get();

        $trackingData = [];

        for ($i = 0; $i < 10; $i++) {
            $antrian = $antrians[$i] ?? null;
            $cekKendaraan = $cekKendaraans[$i] ?? null;
            $hse = $hses[$i] ?? null;
            $cekBarang = $cekBarangs[$i] ?? null;
            $doItem = $doItems[$i] ?? null;

            if (!$antrian)
                continue;

            $trackingData[] = [
                'tracking_number' => 'TRK-' . str_pad($i + 1, 6, '0', STR_PAD_LEFT),

                // Vehicle & Driver Info (Synced from Antrian)
                'nomor_polisi' => $antrian->nomor_polisi,
                'nama_driver' => $antrian->nama_driver,
                'perusahaan' => $cekKendaraan->perusahaan ?? 'PT. WGI Partner',
                'jenis_kendaraan' => $cekKendaraan->jenis_kendaraan ?? 'Truk',

                // Timing & Location
                'tanggal' => $antrian->tgl_antrian,
                'waktu_masuk' => $antrian->jam_diizinkan_masuk,
                'waktu_keluar' => $cekKendaraan->waktu_keluar ?? null,
                'durasi_menit' => $cekKendaraan->durasi_menit ?? rand(30, 120),
                'lokasi' => $antrian->tujuan,
                'lokasi_terakhir' => ($cekBarang && $cekBarang->status_akhir === 'Lolos') ? 'Keluar' : 'Area Bongkar Muat',

                // Foreign Keys
                'antrian_id' => $antrian->id,
                'cek_kendaraan_id' => $cekKendaraan->id ?? null,
                'hse_id' => $hse->id ?? null,
                'do_item_id' => $doItem->id ?? null,
                'cek_barang_id' => $cekBarang->id ?? null,

                // Status & Progress
                'status_keseluruhan' => ($cekBarang && $cekBarang->status_akhir === 'Lolos') ? 'Selesai' : 'Lolos',
                'sudah_antrian' => true,
                'sudah_cek_kendaraan' => (bool) $cekKendaraan,
                'sudah_hse' => (bool) $hse,
                'sudah_cek_barang' => (bool) $cekBarang,
                'sudah_cek_do' => (bool) $doItem,

                // Payload Info
                'jenis_muatan' => $antrian->jenis_antrian,
                'nomor_do' => $doItem->vbeln ?? null,
                'nomor_surat_jalan' => $doItem ? 'SJ-' . $doItem->vbeln : null,
                'jenis_antrian' => $antrian->jenis_antrian,
                'tujuan' => $antrian->tujuan,

                // Check Summaries (Synced from modules)
                'status_antrian' => 'Diizinkan',
                'status_cek_kendaraan' => $cekKendaraan->hasil_pemeriksaan ?? 'Belum',
                'status_hse' => $hse->status ?? 'Belum',
                'status_cek_do' => $doItem ? 'Valid' : 'Belum',
                'status_cek_barang' => $cekBarang->status_akhir ?? 'Belum',

                // Notes
                'catatan_antrian' => 'Queue established for ' . $antrian->tujuan,
                'catatan_kendaraan' => $cekKendaraan->catatan ?? null,
                'catatan_hse' => $hse->catatan_safety ?? null,
                'catatan_barang' => $cekBarang->catatan ?? null,

                // Metadata
                'petugas_pos1' => 'Petugas POS 1',
                'petugas_pos2' => 'Petugas POS 2',
                'waktu_antrian' => $antrian->tgl_antrian ? $antrian->tgl_antrian->copy()->setTimeFromTimeString($antrian->jam_diizinkan_masuk) : null,
                'waktu_cek_kendaraan' => ($cekKendaraan && $cekKendaraan->tanggal) ? $cekKendaraan->tanggal->copy()->setTimeFromTimeString($cekKendaraan->waktu_masuk->format('H:i:s')) : null,
                'waktu_hse' => ($hse && $hse->tanggal) ? $hse->tanggal->copy()->setTimeFromTimeString($hse->waktu->format('H:i:s')) : null,
                'waktu_cek_barang' => ($cekBarang && $cekBarang->tanggal) ? $cekBarang->tanggal->copy()->setTimeFromTimeString($cekBarang->waktu) : null,
                'waktu_selesai' => ($cekBarang && $cekBarang->status_akhir === 'Lolos') ? now() : null,

                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tracking')->insert($trackingData);
    }
}
