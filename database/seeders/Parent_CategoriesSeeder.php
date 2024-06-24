<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Parent_CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parent_categories')->insert([
            //1
            [
                'name' => "トップス",
                'gender' => 0,
            ],
            //2
            [
                'name' => "パンツ",
                'gender' => 0,
            ],
            //3
            [
                'name' => "ワンピース",
                'gender' => 2,
            ],
            //4
            [
                'name' => "スカート",
                'gender' => 2,
            ],
            //5
            [
                'name' => "アウター",
                'gender' => 0,
            ],
            //6
            [
                'name' => "インナー・下着",
                'gender' => 0,
            ],
            //7
            [
                'name' => "ルーム・ホーム",
                'gender' => 0,
            ],

        ]);
    }
}
