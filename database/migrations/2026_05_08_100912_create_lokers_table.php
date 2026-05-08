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
            $table->string('logo')->nullable(); // Nama file foto/logo perusahaan
            $table->string('posisi'); // Contoh: Admin Gudang
            $table->string('perusahaan'); // Contoh: PT. Logistik Maju Jaya

            // Lokasi (Untuk SEO Lokal)
            $table->string('kecamatan'); // Contoh: Adiwerna
            $table->string('kota'); // Contoh: Tegal
            $table->text('alamat'); // Alamat lengkap untuk teks
            $table->text('map')->nullable(); // Untuk link iframe atau koordinat

            // Konten Utama
            $table->text('deskripsi');
            $table->json('persyaratan')->nullable(); // Disimpan sebagai JSON agar bisa di-foreach di Blade
            $table->json('tugas')->nullable(); // Disimpan sebagai JSON
            $table->json('benefit')->nullable(); // Disimpan sebagai JSON (Gaji, BPJS, dll)

            // Informasi Tambahan
            $table->string('gaji')->nullable(); // Contoh: Rp 2.100.000 atau Kompetitif
            $table->date('deadline'); // Tanggal batas lamaran

            // Kontak & Eksternal
            $table->string('no_wa')->nullable();
            $table->string('email')->nullable();
            $table->string('url_blog')->nullable(); // Link ke tips terkait di blog sendiri

            // Sistem & SEO
            $table->string('slug')->unique(); // admin-gudang-adiwerna-tegal-mei-2026
            $table->enum('status', ['Aktif', 'Tutup', 'Arsip'])->default('Aktif');
            $table->string('tipe_pekerjaan')->default('Full Time'); // Full Time, Kontrak, Freelance

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
