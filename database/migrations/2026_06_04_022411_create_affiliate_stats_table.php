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
        Schema::create('affiliate_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_ad_id')->constrained('affiliate_ads')->onDelete('cascade');
            $table->date('date'); // Menyimpan tanggal (YYYY-MM-DD)
            $table->integer('clicks')->default(0);
            $table->unique(['affiliate_ad_id', 'date']); // Mencegah duplikasi tanggal untuk produk yang sama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_stats');
    }
};
