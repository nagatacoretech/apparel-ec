<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductDetail::class;

    public function definition():array
    {
        return [
            'product_id' => fake()->numberBetween(1,50),
            'size_id' => fake()->numberBetween(1,8),
            'color_id' => fake()->numberBetween(1,10),
            'stock' => fake()->numberBetween(1, 50),
        ];
    }
}
