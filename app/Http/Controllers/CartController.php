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
        $exist_product = Cart::where('product_detail_id',$request->product_id)->exists();
        if($exist_product){
            Cart::where('product_detail_id',$request->product_id)->increment('amount',$request->amount);
        }else{
        $cart = new Cart;
        $cart->user_id = Auth::id();
        $cart->product_detail_id = $request->product_id;
        $cart->amount = $request->amount;
        $cart->save();
        }
        return redirect()->route('cart.index');

    }

    public function add_index()
    {
        $carts = Cart::where('user_id',Auth::id())->with('product_detail.product')->get();
        return view('carts.index',compact('carts'));
    }

    public function increase($id)
    {
        $exist_product = Cart::where('user_id',Auth::id())->where('product_detail_id',$id)->exists();
        if($exist_product){
            Cart::where('product_detail_id',$id)->increment('amount');
        }
        return redirect()->route('cart.index');
    }

    public function decrease($id)
    {

        $exist_product = Cart::where('user_id',Auth::id())->where('product_detail_id',$id)->exists();
        if($exist_product){
            Cart::where('product_detail_id',$id)->decrement('amount');
        }
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())->where('product_detail_id', $id)->delete();
        return redirect()->route('cart.index');
    }
}
