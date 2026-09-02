<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('hse', function (Blueprint $table) {
            $table->id();

            // Waktu & Identitas
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('nama_petugas');

            // Subjek Pemeriksaan (Driver / Kendaraan)
            $table->string('nomor_polisi')->nullable();
            $table->string('nama_driver')->nullable();
            $table->string('perusahaan')->nullable();

            // Checklist APD (Alat Pelindung Diri)
            $table->boolean('helm_safety')->default(false);
            $table->boolean('sepatu_safety')->default(false);
            $table->boolean('rompi_safety')->default(false);
            $table->boolean('masker')->default(false);
            $table->boolean('sarung_tangan')->default(false);
            $table->boolean('kacamata_safety')->default(false);

            // Checklist Perlengkapan Safety Kendaraan/Area
            $table->boolean('apar_tersedia')->default(false); // Fire Extinguisher
            $table->boolean('kotak_p3k')->default(false);

            // Hasil & Catatan
            $table->text('catatan_safety')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->enum('status', ['Lolos', 'Perbaikan', 'Ditolak'])->default('Lolos');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hse');
    }
};
