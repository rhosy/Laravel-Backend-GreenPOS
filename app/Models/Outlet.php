<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'merchant_id',
        'province_id',
        'city_id',
        'address',
    ];

    public function merchant() {
        return $this->belongsTo(Merchant::class);
    }

    public function province() {
        return $this->belongsTo(Province::class);
    }

    public function city() {
        return $this->belongsTo(Regency::class);
    }

}
