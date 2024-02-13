<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'is_available',
        'merchant_id',
        'outlet_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function merchant(){
        return $this->belongsTo(Merchant::class);
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }


}
