<?php

namespace App\Models;

// s
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::factory(function (OrderItemsFactory $factory) {
            return $factory->create();
        });
    }

    protected $fillable = ['order_id', 'product_id', 'price', 'amount'];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_id');
    }
}
