<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Orders::class;
    public function definition(): array
    {

        return [
            'user_id' => User::factory(), // ランダムなユーザーを関連付ける
            'total_price' => $this->faker->numberBetween(1000, 100000),
            'created_at' => $this->faker->dateTimeBetween('-10 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-10 year', 'now'),
        ];
    }
}
