<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'test',
        //     'email' => 'test@test.com',
        // ]);
        $this->call([
            // ProductsSeeder::class,
            // ColorsSeeder::class,
            // SizesSeeder::class,
            ProductDetailSeeder::class
        ]);
        $this->call([
            // OrdersSeeder::class,
            // Order_ItemsSeeder::class,
            // Parent_CategoriesSeeder::class,
            // Child_CategoriesSeeder::class,
        ]);
    }
}
