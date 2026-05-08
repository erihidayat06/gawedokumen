<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['judul', 'slug', 'kategori', 'konten', 'gambar', 'penulis'];

    public function lokers()
    {
        return $this->belongsToMany(Loker::class, 'blog_loker');
    }
}
