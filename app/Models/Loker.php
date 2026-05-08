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


    public function blogs()
    {
        // Parameter kedua adalah nama tabel pivot yang kita buat tadi
        return $this->belongsToMany(Blog::class, 'blog_loker');
    }
}
