<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductDetail;
use Database\Factories\ProductDetailFactory;
use Illuminate\Support\Facades\DB;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ProductDetail::factory(4000)->create();
    }
}
