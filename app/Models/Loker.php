<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'persyaratan' => 'array',
        'tugas' => 'array',
        'benefit' => 'array',
        'deadline' => 'date',
    ];

    public function affiliateAds()
    {
        return $this->belongsToMany(
            AffiliateAd::class,     // Model tujuan
            'loker_affiliate_ad',   // Nama tabel pivot sesuai migrasimu
            'loker_id',             // Foreign key untuk model Loker di tabel pivot
            'affiliate_ad_id'       // Foreign key untuk model AffiliateAd di tabel pivot
        );
    }
    public function blogs()
    {
        // Parameter kedua adalah nama tabel pivot yang kita buat tadi
        return $this->belongsToMany(Blog::class, 'blog_loker');
    }
}
