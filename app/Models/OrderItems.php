<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    // protected $guarded = ['id'];
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'amount',
    ];

    protected static function booted()
    {
        static::factory(function (OrderItemsFactory $factory) {
            return $factory->create();
        });
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_id');
    }
}
