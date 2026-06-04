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
        Schema::create('download_stats', function (Blueprint $table) {
            $table->id();
            $table->date('date');           // Tanggal
            $table->string('document_name'); // Tipe dokumen
            $table->integer('total_downloads')->default(0); // Angka counter
            $table->unique(['date', 'document_name']); // Mencegah duplikasi data per hari per dokumen
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_stats');
    }
};
