<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'child_category_id' => fake()->numberBetween(1, 20),
            'price' => fake()->numberBetween(0,30000),
            'visibility' => fake()->boolean(),
            'img_path' => 'https://picsum.photos/200/300',
        ];
    }
}
