<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Hapus kolom affiliate_ad_id di tabel lokers jika sebelumnya sudah dibuat
        if (Schema::hasColumn('lokers', 'affiliate_ad_id')) {
            Schema::table('lokers', function (Blueprint $table) {
                $table->dropForeign(['affiliate_ad_id']);
                $table->dropColumn('affiliate_ad_id');
            });
        }

        // 2. Buat tabel pivot penghubung Many-to-Many
        Schema::create('loker_affiliate_ad', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel lokers
            $table->foreignId('loker_id')
                ->constrained('lokers')
                ->onDelete('cascade'); // Jika loker dihapus, hubungan di pivot ikut terhapus

            // Relasi ke tabel affiliate_ads
            $table->foreignId('affiliate_ad_id')
                ->constrained('affiliate_ads')
                ->onDelete('cascade'); // Jika iklan dihapus, hubungan di pivot ikut terhapus

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loker_affiliate_ad');

        // Kembalikan kolom nullable jika di-rollback (opsional)
        Schema::table('lokers', function (Blueprint $table) {
            $table->foreignId('affiliate_ad_id')->nullable()->constrained('affiliate_ads')->onDelete('set null');
        });
    }
};
