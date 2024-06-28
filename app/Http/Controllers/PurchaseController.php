<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Mail\CustomerMail;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Stripe\Stripe;
use Stripe\Customer;
use Laravel\Cashier\Cashier;

use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));


        $publicKey = env('STRIPE_PUBLIC_KEY');
        foreach($request->stripe_items as  $s_items)
        {
            $lineItems[] = [
                    'price_data' => [
                        'product_data' => [
                            'name' => $s_items['name'],
                            'images' => [$s_items['img']],
                        ],
                        'currency' => 'jpy',
                        'unit_amount' => $s_items['price'],
                    ],
                    'quantity' =>  $s_items['amount']
                ];
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        return view('purchase.checkout',compact('checkout_session', 'publicKey'));
    }

    public function success()
    {
        $carts = DB::table('carts')
        ->select('products.id','carts.product_detail_id','products.img_path', 'products.name', 'sizes.size', 'color.color', 'products.price', 'carts.amount','product_details.stock')
        ->join('product_details', 'carts.product_detail_id', '=', 'product_details.id')
        ->join('products', 'product_details.product_id', '=', 'products.id')
        ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
        ->join('color', 'product_details.color_id', '=', 'color.id')
        ->where('carts.user_id', Auth::id())
        ->get();

        DB::beginTransaction();
        try {
            $total_price = 0;
            foreach($carts as $cart_product)
            {
                $total_price += $cart_product->price*$cart_product->amount;
            }

            if($total_price == 0)
            {
                return view('purchase.success');
            }

            $order = new Orders;
            $order->user_id = Auth::id();
            $order->total_price = $total_price;
            $order->save();


            foreach($carts as $cart_product){
                $order_item = new OrderItems;
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart_product->product_detail_id;
                $order_item->price = $cart_product->price;
                $order_item->amount = $cart_product->amount;
                $order_item->save();
                ProductDetail::where('id',$cart_product->product_detail_id)->decrement('stock',$cart_product->amount);
            }


            $stock_out = ProductDetail::where('stock','<',0)->count();
            if($stock_out >= 1){
                throw new \Exception('申し訳ございません。在庫切れです。');
            }

            Cart::where('user_id',Auth::id())->delete();

            DB::commit();


        } catch (\Exception $e) {
            $error = $e->getMessage();

            if(isset($error)){
                DB::rollback();
                return view('carts.stockout');
            }
        }

        $order_items = OrderItems::select('products.name', 'order_items.price', 'order_items.amount', 'sizes.size', 'color.color')
        ->join('product_details', 'order_items.product_id', '=', 'product_details.id')
        ->join('products', 'product_details.product_id', '=', 'products.id')
        ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
        ->join('color', 'product_details.color_id', '=', 'color.id')
        ->where("order_items.order_id",$order->id)
        ->get();

        Mail::to(Auth::user()->email)->send(new CustomerMail($order_items));
        Mail::to("admin@admin.com")->send(new AdminMail($order_items));


        return view('purchase.success');
    }

    public function cancel(){
        echo 'キャンセル';
    }

}

