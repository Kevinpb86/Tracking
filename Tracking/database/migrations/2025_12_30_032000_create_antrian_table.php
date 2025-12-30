<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('antrian_pos1', function (Blueprint $table) {
            $table->id();
            $table->string('no_antrian')->unique();
            $table->string('nomor_polisi', 20);
            $table->string('nama_driver', 100);
            $table->string('jenis_antrian', 50); // Finish Product, Use Oil, Rawn Material, Drum.
            $table->string('tujuan', 100);

            // Document References
            $table->string('emr', 100)->nullable();

            // Scheduling & Status
            $table->date('tgl_antrian');
            $table->time('jam_diizinkan_masuk')->nullable();
            $table->string('status', 50)->default('Waiting'); // Waiting, Processed, Completed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrian_pos1');
    }
};
