<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Child_CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

// Tシャツ・カットソー
// ブラトップ
// シャツ・ブラウス
// カーディガン
// ニット・セーター
// スウェット・パーカ
// すべてのトップス

        DB::table('child_categories')->insert([
            [
                'category_id' =>"1",
                'name' => "Tシャツ・カットソー",
                'gender' => "2",
            ],
            [
                'category_id' =>"1",
                'name' => "ブラトップ",
                'gender' => "2",
            ],
            [
                'category_id' =>"1",
                'name' => "シャツ・ブラウス",
                'gender' => "2",
            ],
            [
                'category_id' =>"1",
                'name' => "カーディガン",
                'gender' => "2",
            ],
            [
                'category_id' =>"1",
                'name' => "ニット・セーター",
                'gender' => "2",
            ],
            [
                'category_id' =>"1",
                'name' => "スウェット・パーカ",
                'gender' => "2",
            ],
            [
                'category_id' =>"1",
                'name' => "すべてのトップス",
                'gender' => "2",
            ],
            [
                'category_id' =>"1",
                'name' => "Tシャツ・カットソー",
                'gender' => "1",
            ],
            [
                'category_id' =>"1",
                'name' => "ポロシャツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"1",
                'name' => "カジュアルシャツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"1",
                'name' => "ドレスシャツ・ワイシャツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"1",
                'name' => "カーディガン",
                'gender' => "1",
            ],
            [
                'category_id' =>"1",
                'name' => "スウェット・パーカ",
                'gender' => "1",
            ],
            [
                'category_id' =>"1",
                'name' => "ニット・セーター",
                'gender' => "1",
            ],
            [
                'category_id' =>"1",
                'name' => "すべてのトップス",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "ワイドパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "ジーンズ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "カーゴパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "カジュアルパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "トラウザー",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "アンクルパンツ・クロップドパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "ショートパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "レギンスパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "スウェットパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "すべてのパンツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"2",
                'name' => "トラウザー",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "ジーンズ・カラージーンズ",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "チノパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "パラシュート・カーゴパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "ワイドパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "ショートパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "スウェットパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "アンクルパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"2",
                'name' => "すべてのパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"3",
                'name' => "ミニ丈ワンピース",
                'gender' => "2",
            ],
            [
                'category_id' =>"3",
                'name' => "マキシ丈・ロングワンピース",
                'gender' => "2",
            ],
            [
                'category_id' =>"3",
                'name' => "ドレス",
                'gender' => "2",
            ],
            [
                'category_id' =>"3",
                'name' => "セットアップ",
                'gender' => "2",
            ],
            [
                'category_id' =>"3",
                'name' => "オールインワン",
                'gender' => "2",
            ],
            [
                'category_id' =>"4",
                'name' => "ミニスカート",
                'gender' => "2",
            ],
            [
                'category_id' =>"4",
                'name' => "マキシ丈・ロングスカート",
                'gender' => "2",
            ],
            [
                'category_id' =>"5",
                'name' => "ブルゾン・パーカ",
                'gender' => "2",
            ],
            [
                'category_id' =>"5",
                'name' => "ジャケット",
                'gender' => "2",
            ],
            [
                'category_id' =>"5",
                'name' => "コート",
                'gender' => "2",
            ],
            [
                'category_id' =>"5",
                'name' => "ウルトラライトダウン・パフテック",
                'gender' => "2",
            ],
            [
                'category_id' =>"5",
                'name' => "カスタムオーダージャケット",
                'gender' => "2",
            ],
            [
                'category_id' =>"5",
                'name' => "すべてのアウター",
                'gender' => "2",
            ],
            [
                'category_id' =>"5",
                'name' => "ブルゾン・パーカ",
                'gender' => "1",
            ],
            [
                'category_id' =>"5",
                'name' => "ジャケット",
                'gender' => "1",
            ],
            [
                'category_id' =>"5",
                'name' => "コート",
                'gender' => "1",
            ],
            [
                'category_id' =>"5",
                'name' => "ウルトラライトダウン・パフテック",
                'gender' => "1",
            ],
            [
                'category_id' =>"5",
                'name' => "カスタムオーダージャケット",
                'gender' => "1",
            ],
            [
                'category_id' =>"5",
                'name' => "すべてのアウター",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "ブラトップ",
                'gender' => "2",
            ],
            [
                'category_id' =>"6",
                'name' => "ショーツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"6",
                'name' => "レギンス・タイツ",
                'gender' => "2",
            ],
            [
                'category_id' =>"6",
                'name' => "ソックス・靴下",
                'gender' => "2",
            ],
            [
                'category_id' =>"6",
                'name' => "コットンインナー",
                'gender' => "2",
            ],
            [
                'category_id' =>"6",
                'name' => "すべてのインナー・下着",
                'gender' => "2",
            ],
            [
                'category_id' =>"6",
                'name' => "ボクサーブリーフ・トランクス",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "ソックス・靴下",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "前あきインナー・その他",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "すべてのインナー・下着",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "ルームウェア・パジャマ",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "ルームパンツ",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "ルームシューズ",
                'gender' => "1",
            ],
            [
                'category_id' =>"6",
                'name' => "すべてのルーム・ホーム",
                'gender' => "1",
            ],

        ]);
    }
}
