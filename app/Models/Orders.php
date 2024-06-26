<?php

namespace App\Models;

use Database\Factories\OrdersFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price'];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
