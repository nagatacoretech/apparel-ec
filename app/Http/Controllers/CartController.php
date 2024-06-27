<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        $isValidCombination = ProductDetail::where('product_id', $request->product_id)
        ->where('size_id', $request->size)
        ->where('color_id', $request->color)
        ->exists();

        if (!$isValidCombination) {
            // 在庫がない場合の処理
            return redirect()->back()->with('error', '選択したサイズとカラーの組み合わせは在庫がありません。');
        }

        $productDetailId = ProductDetail::where('product_id', $request->product_id)
            ->where('size_id', $request->size)
            ->where('color_id', $request->color)
            ->pluck('id')
            ->first();
        // dd($request);
        $exist_product = Cart::where('user_id',Auth::id())->where('product_detail_id',$productDetailId)->exists();
        if($exist_product){
            $cart = Cart::where('product_detail_id',$productDetailId)->increment('amount',$request->amount);
        }else{
        $cart = new Cart;
        $cart->user_id = Auth::id();
        $cart->product_detail_id = $productDetailId;
        $cart->amount = $request->amount;
        $cart->save();
        }
        return redirect()->route('cart.index');

    }

    public function add_index()
    {
        $carts = DB::table('carts')
            ->select('products.id','carts.product_detail_id','products.img_path', 'products.name', 'sizes.size', 'color.color', 'products.price', 'carts.amount','product_details.stock')
            ->join('product_details', 'carts.product_detail_id', '=', 'product_details.id')
            ->join('products', 'product_details.product_id', '=', 'products.id')
            ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
            ->join('color', 'product_details.color_id', '=', 'color.id')
            ->where('carts.user_id', Auth::id())
            ->get();
        // dd($carts);
        $total_price = 0;
        foreach($carts as $cart)
        {
            $total_price += $cart->price*$cart->amount;
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
