<?php

namespace Database\Seeders;

use App\Models\OrderItems;
use Illuminate\Database\Seeder;

class Order_ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        OrderItems::factory()
            ->count(100)
            ->create();
    }
}
