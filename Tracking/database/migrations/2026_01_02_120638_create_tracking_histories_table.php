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
        Schema::create('tracking_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_id');
            $table->string('tracking_number', 50);
            $table->string('action_type', 50); // created, status_changed, etc.
            $table->string('action_name', 100);
            $table->text('description')->nullable();
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->string('petugas', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->timestamps();

            $table->foreign('tracking_id')->references('id')->on('tracking')->onDelete('cascade');
            $table->index('tracking_id');
            $table->index('tracking_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_histories');
    }
};
