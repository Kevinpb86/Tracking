<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Hse;
use App\Models\AntrianPos1;
use Carbon\Carbon;

class HSESeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('hse')->truncate();
        Schema::enableForeignKeyConstraints();
        // Ensure Antrian data exists
        if (AntrianPos1::count() === 0) {
            $this->call(AntrianPos1Seeder::class);
        }

        // Get 10 data from AntrianPos1
        $antrians = AntrianPos1::take(10)->get();

        // Fake companies based on queue type to be somewhat consistent/realistic
        $companies = [
            'Finish Product' => ['PT. Logistik Utama', 'PT. Trans Cargo Ind', 'PT. Fast Delivery'],
            'Use Oil' => ['PT. Eco Oil Transport', 'PT. Green Energy', 'PT. Oilindo'],
            'Raw Material' => ['PT. Raw Material Supply', 'PT. Alam Semesta', 'PT. Mineral Jaya'],
            'Drum' => ['PT. Drumindo', 'PT. Packaging Solusi', 'PT. Container Nusantara'],
        ];

        foreach ($antrians as $antrian) {
            // Determine company based on jenis_antrian or random
            $type = $antrian->jenis_antrian ?? 'Finish Product'; // Fallback
            $companyList = $companies[$type] ?? $companies['Finish Product'];
            $company = $companyList[array_rand($companyList)];

            Hse::create([
                'tanggal' => Carbon::today(),
                'waktu' => Carbon::now()->format('H:i'),
                'nama_petugas' => 'Petugas Safety',
                'nomor_polisi' => $antrian->nomor_polisi,
                'nama_driver' => $antrian->nama_driver,
                'perusahaan' => $company, // Synthesized

                // Checklist APD
                'helm_safety' => true,
                'sepatu_safety' => true,
                'rompi_safety' => true,
                'masker' => true,
                'sarung_tangan' => true,
                'kacamata_safety' => true,

                // Checklist Perlengkapan Safety
                'apar_tersedia' => true,
                'kotak_p3k' => true,

                'catatan_safety' => 'Lengkap dan aman',
                'tindak_lanjut' => '-',
                'status' => 'Lolos',
            ]);
        }
    }
}
