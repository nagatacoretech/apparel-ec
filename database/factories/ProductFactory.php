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
        $name = ['エアリズムコットンオーバーサイズTシャツ',
        'ドライカノコボーダーポロシャツ',
        'ウィンドプルーフスタンドブルゾン',
        'ブロックテックパーカ',
        'ウルトラストレッチエアリズムワンピース',
        'ギャザーパックオープンワンピース',
        'サテンスカート',    'シフォンスカート',
        '感動ジャケット', 'ブロックテックハーフコート','エアリズムコットンメッシュセット'];

        return [
            'name' => fake()->randomElement($name),
            'child_category_id' => fake()->numberBetween(1, 70),
            'price' => fake()->numberBetween(1000,10000),
            'visibility' => fake()->boolean(),
            'img_path' => 'https://picsum.photos/200/300',
        ];
    }
}
