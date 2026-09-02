<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Tabel tracking ini mencatat semua aktivitas dan pergerakan kendaraan
     * di seluruh sistem tracking (Pos 1, Pos 2, HSE, Cek Kendaraan, Cek Barang)
     */
    public function up(): void
    {
        Schema::create('tracking', function (Blueprint $table) {
            // Primary Key
            $table->id();

            // Tracking Number - Unique identifier untuk setiap tracking record
            $table->string('tracking_number', 50)->unique();

            // ========================================
            // INFORMASI DASAR KENDARAAN
            // ========================================
            $table->string('nomor_polisi', 20)->index();
            $table->string('nama_driver', 100);
            $table->string('perusahaan', 100)->nullable();
            $table->enum('jenis_kendaraan', [
                'Truk',
                'Pickup',
                'Mobil Box',
                'Tangki',
                'Lainnya'
            ]);

            // ========================================
            // INFORMASI WAKTU & LOKASI
            // ========================================
            $table->date('tanggal')->index();
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->integer('durasi_menit')->nullable();
            // Lokasi asal/tujuan spesifik
            $table->string('lokasi', 100)->nullable();
            // Lokasi/Pos saat ini
            $table->enum('lokasi_terakhir', [
                'Pos 1 - Antrian',
                'Pos 1 - Cek Kendaraan',
                'Pos 1 - HSE',
                'Pos 2 - Cek DO',
                'Pos 2 - Cek Barang',
                'Area Bongkar Muat',
                'Keluar',
                'Ditolak'
            ])->default('Pos 1 - Antrian');

            // ========================================
            // REFERENSI KE TABEL LAIN
            // ========================================
            // Foreign keys ke tabel-tabel terkait
            $table->unsignedBigInteger('antrian_id')->nullable();
            $table->unsignedBigInteger('cek_kendaraan_id')->nullable();
            $table->unsignedBigInteger('hse_id')->nullable();
            $table->unsignedBigInteger('do_item_id')->nullable();
            $table->unsignedBigInteger('cek_barang_id')->nullable();

            // ========================================
            // STATUS & PROGRESS TRACKING
            // ========================================
            $table->enum('status_keseluruhan', [
                'Menunggu',           // Baru masuk antrian
                'Dalam Pemeriksaan',  // Sedang diperiksa
                'Lolos',              // Lolos semua pemeriksaan
                'Lolos Bersyarat',    // Lolos dengan catatan
                'Ditahan',            // Ditahan untuk pemeriksaan lebih lanjut
                'Ditolak',            // Ditolak masuk
                'Selesai'             // Sudah keluar dari area
            ])->default('Menunggu');

            // Progress tracking - checklist tahapan yang sudah dilalui
            $table->boolean('sudah_antrian')->default(false);
            $table->boolean('sudah_cek_kendaraan')->default(false);
            $table->boolean('sudah_hse')->default(false);
            $table->boolean('sudah_cek_barang')->default(false);
            $table->boolean('sudah_cek_do')->default(false);

            // ========================================
            // INFORMASI MUATAN/BARANG
            // ========================================
            $table->string('jenis_muatan', 100)->nullable();
            $table->string('nomor_do', 50)->nullable();
            $table->string('nomor_surat_jalan', 50)->nullable();
            $table->enum('jenis_antrian', [
                'Finish Product',
                'Use Oil',
                'Raw Material',
                'Drum',
                'Lainnya'
            ])->nullable();
            $table->string('tujuan', 100)->nullable();

            // ========================================
            // HASIL PEMERIKSAAN (SUMMARY)
            // ========================================
            // Status dari setiap tahap pemeriksaan
            $table->enum('status_antrian', ['Pending', 'Diizinkan', 'Ditolak', 'Belum'])->default('Belum');
            $table->enum('status_cek_kendaraan', ['Lolos', 'Lolos Bersyarat', 'Tidak Lolos', 'Belum'])->default('Belum');
            $table->enum('status_hse', ['Lolos', 'Perbaikan', 'Ditolak', 'Belum'])->default('Belum');
            $table->enum('status_cek_do', ['Valid', 'Tidak Valid', 'Belum'])->default('Belum');
            $table->enum('status_cek_barang', ['Lolos', 'Ditahan', 'Ditolak', 'Belum'])->default('Belum');

            // ========================================
            // CATATAN & DOKUMENTASI
            // ========================================
            $table->text('catatan_umum')->nullable();
            $table->text('catatan_antrian')->nullable();
            $table->text('catatan_kendaraan')->nullable();
            $table->text('catatan_hse')->nullable();
            $table->text('catatan_do')->nullable();
            $table->text('catatan_barang')->nullable();

            // Alasan jika ditolak/ditahan
            $table->text('alasan_penolakan')->nullable();
            $table->text('tindak_lanjut')->nullable();

            // ========================================
            // PETUGAS YANG MENANGANI
            // ========================================
            $table->string('petugas_pos1', 100)->nullable();
            $table->string('petugas_pos2', 100)->nullable();

            // ========================================
            // METADATA & AUDIT TRAIL
            // ========================================
            $table->timestamp('waktu_antrian')->nullable();
            $table->timestamp('waktu_cek_kendaraan')->nullable();
            $table->timestamp('waktu_hse')->nullable();
            $table->timestamp('waktu_cek_do')->nullable();
            $table->timestamp('waktu_cek_barang')->nullable();
            $table->timestamp('waktu_selesai')->nullable();

            // IP Address & User Agent untuk audit
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            // Soft deletes untuk data history
            $table->softDeletes();

            // Timestamps (created_at, updated_at)
            $table->timestamps();

            // ========================================
            // INDEXES UNTUK PERFORMA
            // ========================================
            $table->index('status_keseluruhan');
            $table->index('lokasi_terakhir');
            $table->index(['tanggal', 'status_keseluruhan']);
            $table->index(['nomor_polisi', 'tanggal']);
            $table->index('created_at');

            // ========================================
            // FOREIGN KEY CONSTRAINTS
            // ========================================
            $table->foreign('antrian_id')
                ->references('id')
                ->on('antrian_pos1')
                ->onDelete('set null');

            $table->foreign('cek_kendaraan_id')
                ->references('id')
                ->on('cek_kendaraan')
                ->onDelete('set null');

            $table->foreign('hse_id')
                ->references('id')
                ->on('hse')
                ->onDelete('set null');

            $table->foreign('do_item_id')
                ->references('id')
                ->on('do_items')
                ->onDelete('set null');

            $table->foreign('cek_barang_id')
                ->references('id')
                ->on('cek_barang')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
