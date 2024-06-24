<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;

class ItemController extends Controller
{
    public function index()
    {
        $products = ProductDetail::with('product')->get();
        // dd($products);
        return view('items.index',compact('products'));
    }

    public function show($id)
    {
        $product_id = ProductDetail::find($id);
        return view('items.show',compact('product_id'));
    }
}
