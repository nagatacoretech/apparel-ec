<?php

namespace Database\Factories;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_Items>
 */
class OrderItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = OrderItems::class;
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 100),
            'product_id' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1000, 10000),
            'amount' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
