<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_id',
        'category_id',
        'nama_produk',
        'deskripsi_pendek',
        'harga_asli',
        'harga_diskon',
        'affiliate_url',
        'custom_slug',
        'gambar_produk',
        'status',
    ];

    // Relasi ke Platform
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function affiliateAds()
    {
        return $this->belongsToMany(AffiliateAd::class, 'loker_affiliate_ad', 'loker_id', 'affiliate_ad_id')
            ->withTimestamps();
    }
}
