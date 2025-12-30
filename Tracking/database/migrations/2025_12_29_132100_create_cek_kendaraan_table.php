<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Tabel untuk mencatat pemeriksaan kendaraan di Pos 1
     * Fokus pada validasi dokumen dan kondisi kendaraan
     */
    public function up(): void
    {
        Schema::create('cek_kendaraan', function (Blueprint $table) {
            // Primary Key
            $table->id();

            // Informasi Waktu Pemeriksaan
            $table->date('tanggal');
            $table->time('waktu_masuk');
            $table->time('waktu_keluar')->nullable();

            // Informasi Kendaraan
            $table->string('nomor_polisi', 20);
            $table->enum('jenis_kendaraan', [
                'Truk',
                'Pickup',
                'Mobil Box',
                'Tangki',
                'Lainnya'
            ]);
            $table->string('nama_driver', 100);
            $table->string('perusahaan', 100)->nullable();


            // Pemeriksaan Dokumen (Checklist)
            $table->boolean('surat_jalan')->default(false);
            $table->boolean('stnk_valid')->default(false);
            $table->boolean('sim_valid')->default(false);
            $table->boolean('kir_valid')->default(false);

            // Pemeriksaan Kondisi Kendaraan
            $table->enum('kondisi_ban', ['Baik', 'Kurang Baik', 'Tidak Layak']);

            $table->enum('kondisi_lampu', ['Baik', 'Kurang Baik', 'Tidak Layak']);
            $table->enum('kondisi_rem', ['Baik', 'Kurang Baik', 'Tidak Layak']);
            $table->enum('kondisi_lampu_sen', ['Baik', 'Kurang Baik', 'Tidak Layak']);
            $table->boolean('kaca_spion_lengkap');

            // Status Hasil Pemeriksaan
            $table->enum('hasil_pemeriksaan', [
                'Lolos',
                'Lolos Bersyarat',
                'Tidak Lolos'
            ])->default('Lolos');

            $table->text('catatan')->nullable();

            // Petugas yang Memeriksa
            $table->string('nama_petugas', 100);

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('tanggal');
            $table->index('nomor_polisi');
            $table->index('hasil_pemeriksaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_kendaraan');
    }
};
