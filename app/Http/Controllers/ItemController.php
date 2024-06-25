<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;

class ItemController extends Controller
{
    public function index()
    {
        $products = Product::select('id','name', 'price', 'img_path')
                    ->where('visibility', 1)
                    ->get();
            $parent_categories = ParentCategory::all();
            $child_categories = ChildCategory::all();

        // dd($products);
        return view('items.index',compact('products','parent_categories','child_categories'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('items.show',compact('product'));
    }
}
