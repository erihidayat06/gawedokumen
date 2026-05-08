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
}
