<?php

namespace App\Models;

use Database\Factories\OrderItemsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = ['order_items'];
    // protected $guarded = ['id'];
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected static function booted()
    {
        static::factory(function (OrderItemsFactory $factory) {
            return $factory->create();
        });
    }
}
