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
        Schema::table('blogs', function (Blueprint $table) {
            // Mengubah tipe data kolom 'konten' menjadi mediumText agar muat hingga 16MB teks
            $table->mediumText('konten')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Mengembalikan tipe data kolom 'konten' ke text standar atau varchar jika rollback
            $table->text('konten')->change();
        });
    }
};
