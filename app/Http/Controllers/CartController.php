<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product_id;
        $cart->amount = $request->amount;
        $cart->save();
        return redirect()->route('cart.index');

    }

    public function add_index()
    {
        $products = ProductDetail::all();
        $carts = Cart::all();
        // dd($cart);
        return view('carts.index',compact('carts','products'));
    }
}
