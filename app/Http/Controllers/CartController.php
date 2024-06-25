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
        $exist_product = Cart::where('product_id',$request->product_id)->exists();
        if($exist_product){
            Cart::where('product_id',$request->product_id)->increment('amount',$request->amount);
        }else{
        $cart = new Cart;
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product_id;
        $cart->amount = $request->amount;
        $cart->save();
        }
        return redirect()->route('cart.index');

    }

    public function add_index()
    {
        $carts = Cart::with('product')->get();
        $cart_details = Cart::all();
        foreach($cart_details as $cart_detail)
        // dd($cart_detail);
        return view('carts.index',compact('carts','cart_detail'));
    }

    public function remove($id)
    {
        $user_id = Auth::id();
        Cart::where('user_id', $user_id)->where('product_id', $id)->delete();
        return redirect()->route('cart.index');
    }
}
