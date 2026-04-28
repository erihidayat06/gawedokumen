<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();

            $table->string('nama_template'); // Simpan path gambar
            $table->string('cv_image')->nullable(); // Simpan path gambar

            // Konfigurasi Warna (Branding/UI)
            $table->string('color_primary_text'); // Warna teks utama
            $table->string('color_body_text');    // Warna teks body
            $table->string('color_sidebar_bg');   // Background sidebar
            $table->string('color_sidebar_text'); // Warna teks sidebar

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
