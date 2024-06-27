<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
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
        // $carts = Cart::where('user_id',Auth::id())->with('product_detail.product')->get();
        $carts = DB::table('carts')
            ->select('products.id','carts.product_detail_id','products.img_path', 'products.name', 'sizes.size', 'color.color', 'products.price', 'carts.amount')
            ->join('product_details', 'carts.product_detail_id', '=', 'product_details.id')
            ->join('products', 'product_details.product_id', '=', 'products.id')
            ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
            ->join('color', 'product_details.color_id', '=', 'color.id')
            ->where('carts.user_id', Auth::id())
            ->get();
        $total_price = 0;
        foreach($carts as $cart)
        {
<<<<<<< HEAD
            // dd($cart);
            // dd($cart->product_detail->product->price);
            $total_price += $cart->price*$cart->amount;
=======
            $total_price += $cart->product_detail->product->price*$cart->amount;
>>>>>>> parent of 0935e24 (一度)
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
}
