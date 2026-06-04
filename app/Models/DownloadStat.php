<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadStat extends Model
{
    // Mengizinkan kolom-kolom ini untuk diisi melalui method create()
    protected $guarded = ['id'];

    // Karena kita biasanya menggunakan kolom 'date' secara manual
    // dan tidak selalu butuh 'updated_at', kita bisa nonaktifkan timestamps default
    public $timestamps = false;
}
