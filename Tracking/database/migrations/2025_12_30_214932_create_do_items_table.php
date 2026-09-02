<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('do_items', function (Blueprint $table) {
            $table->id();
            $table->string('vbeln'); // No Dokumen Penjualan
            $table->string('posnr'); // No Posisi Item dalam Dokumen Perjalanan
            $table->string('matnr'); // Nomor Material
            $table->text('arktx')->nullable(); // Teks Pendek
            $table->decimal('ifimg', 10, 2); // Kuantitas Item
            $table->string('vrkme'); // Satuan Ukuran
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('do_items');
    }
};
