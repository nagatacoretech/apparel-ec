<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        // dd($request);
        $exist_product = Cart::where('user_id',Auth::id())->where('product_detail_id',$request->product_id)->exists();
        if($exist_product){
            $cart = Cart::where('product_detail_id',$request->product_id)->increment('amount',$request->amount);
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
        $total_price = 0;
        foreach($carts as $cart)
        {
            $total_price += $cart->product_detail->product->price*$cart->amount;
        }

        return view('carts.index',compact('carts','total_price'));
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

    public function purchase(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate total price
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->productDetail->price * $item->amount;
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            Order_Item::create([
                'order_id' => $order->id,
                'product_id' => $item->productDetail->product_id,
                'price' => $item->productDetail->price,
                'amount' => $item->amount,
            ]);
        }

        // Clear cart
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('history.index')->with('success', 'Purchase successful.');
    }
}
