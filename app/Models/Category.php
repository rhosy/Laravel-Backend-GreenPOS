<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'merchant_id',
        'outlet_id'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
