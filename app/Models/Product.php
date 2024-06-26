<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ProductDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
