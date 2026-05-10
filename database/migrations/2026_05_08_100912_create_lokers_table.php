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
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();

            // Branding & Identitas
            $table->string('logo')->nullable();
            $table->string('posisi');
            $table->string('perusahaan');

            // Lokasi (Untuk SEO Lokal)
            $table->string('kecamatan');
            $table->string('kota');
            $table->text('alamat');
            $table->text('map')->nullable();

            // Kualifikasi Utama (TAMBAHAN BARU)
            $table->string('minimal_pendidikan')->nullable(); // Contoh: SMA/SMK, D3, S1
            $table->string('pengalaman')->nullable(); // Contoh: Minimal 1 Tahun, Fresh Graduate

            // Konten Utama
            $table->text('deskripsi')->nullable();
            $table->json('persyaratan')->nullable();
            $table->json('tugas')->nullable();
            $table->json('benefit')->nullable();

            // Informasi Tambahan
            $table->string('gaji')->nullable();
            $table->date('deadline')->nullable();

            // Kontak & Eksternal
            $table->string('no_wa')->nullable();
            $table->string('email')->nullable();
            $table->string('link_pendaftaran')->nullable();
            $table->text('url_blog')->nullable();

            // Sistem & SEO
            $table->string('slug')->unique();
            $table->enum('status', ['Aktif', 'Tutup', 'Arsip'])->default('Aktif');
            $table->string('tipe_pekerjaan')->default('Full Time');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokers');
    }
};
