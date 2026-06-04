<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateLog extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'datetime',
    ];
    public function affiliateAd()
    {
        return $this->belongsTo(AffiliateAd::class, 'affiliate_ad_id');
    }
    public $timestamps = false;
}
