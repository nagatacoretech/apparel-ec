<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = ['user_id', 'product_details_id', 'amount'];

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_details_id');
    }
}
