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
        Schema::create('affiliate_ads', function (Blueprint $table) {
            $table->id();
            // Relasi ke platform dan kategori
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            $table->string('nama_produk');
            $table->text('deskripsi_pendek')->nullable();

            // Kolom Harga Baru (Format: 12 digit angka, 2 digit di belakang koma)
            // Contoh: 9999999999.00 (Sangat aman untuk nominal Rupiah)
            $table->decimal('harga_asli', 12, 2)->nullable(); // nullable jika sewaktu-waktu produk tidak punya coretan harga asli
            $table->decimal('harga_diskon', 12, 2)->nullable(); // harga final setelah didiskon

            $table->text('affiliate_url'); // Link Shopee Affiliate kamu (shope.ee/xxx)
            $table->string('custom_slug', 100)->unique()->nullable(); // Contoh shortlink internal: domain.com/rekomendasi/charger
            $table->string('gambar_produk')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('total_views')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_ads');
    }
};
