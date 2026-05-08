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
        Schema::create('blog_loker', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel lokers
            $table->foreignId('loker_id')->constrained('lokers')->onDelete('cascade');
            // Menghubungkan ke tabel blogs
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_loker');
    }
};
