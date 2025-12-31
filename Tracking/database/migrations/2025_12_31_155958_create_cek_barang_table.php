<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cek_barang', function (Blueprint $table) {
            $table->id();

            // Informasi Dasar
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('nama_pemeriksa');

            // Informasi Kendaraan & Pengemudi
            $table->string('nomor_polisi');
            $table->string('nama_pengemudi');
            $table->string('nomor_do')->nullable(); // Nomor Delivery Order

            // Pemeriksaan Barang (Simple/Kasar)
            $table->string('jenis_barang'); // Jenis barang yang dikirim
            $table->integer('jumlah_barang'); // Jumlah barang
            $table->string('satuan'); // Satuan (Karton, Pcs, Kg, dll)

            // Kondisi Barang (Simple Check)
            $table->enum('kondisi_kemasan', ['Baik', 'Rusak', 'Basah'])->default('Baik');
            $table->enum('kesesuaian_jumlah', ['Sesuai', 'Kurang', 'Lebih'])->default('Sesuai');
            $table->enum('kelengkapan_dokumen', ['Lengkap', 'Tidak Lengkap'])->default('Lengkap');

            // Pemeriksaan Khusus Truck Tangki Oli
            $table->enum('jenis_kendaraan', ['Truck Tangki', 'Truck Biasa', 'Lainnya'])->default('Truck Biasa');
            $table->enum('kebocoran_tangki', ['Tidak Ada', 'Ada Kebocoran Kecil', 'Ada Kebocoran Besar'])->default('Tidak Ada')->nullable();
            $table->enum('kondisi_seal_tangki', ['Baik', 'Rusak', 'Tidak Ada'])->default('Baik')->nullable();
            $table->text('lokasi_kebocoran')->nullable(); // Lokasi kebocoran jika ada

            // Catatan & Status
            $table->text('catatan')->nullable();
            $table->enum('status_akhir', ['Lolos', 'Ditahan', 'Ditolak'])->default('Lolos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_barang');
    }
};
