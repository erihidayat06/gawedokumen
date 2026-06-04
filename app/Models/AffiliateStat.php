<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateStat extends Model
{
    protected $fillable = ['affiliate_ad_id', 'date', 'clicks'];
}
