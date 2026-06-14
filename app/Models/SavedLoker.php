<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedLoker extends Model
{
    protected $guarded = ['id'];

    // Menghubungkan ke tabel 'lokers'
    public function loker(): BelongsTo
    {
        return $this->belongsTo(Loker::class);
    }
}
