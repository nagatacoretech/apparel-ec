<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = ['XL', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL'];

        // サイズデータを挿入
        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'size' => $size,
            ]);
        }
    }
}
