<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use App\Models\Color;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;

class ItemController extends Controller
{
    public function index()
    {
        $products = Product::select('id','name', 'price', 'img_path')
                    ->where('visibility', 1)
                    ->get();
            $parent_categories = ParentCategory::all();
            $child_categories = ChildCategory::all();
            $sizes = Size::all();
            $colors = Color::all();

        // dd($products);
        return view('items.index',compact('products','parent_categories','child_categories'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $sizes = ProductDetail::select('product_details.size_id', 'sizes.size')
            ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
            ->where('product_details.product_id', $id)
            ->distinct()
            ->get();

        $colors = ProductDetail::select('product_details.color_id','color.color')
            ->join('color', 'product_details.color_id', '=', 'color.id')
            ->where('product_details.product_id', $id)
            ->distinct()
            ->get();
        return view('items.show',compact('product','sizes','colors'));
    }
}
