<?php

namespace App\Models;

use Database\Factories\OrderItemsFactory;
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
}
