<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Mail\CustomerMail;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderItems;
use App\Models\Orders;
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
        DB::beginTransaction();
        try {
            foreach($request->order_items as  $item){


                if($item['stock'] == 0){
                    throw new \Exception('申し訳ございません。在庫切れです。');
                }
            }

            $order = new Orders;
            $order->user_id = Auth::id();
            $order->total_price = $request->total_price;
            $order->save();

            foreach($request->order_items as  $item){
                $order_item = new OrderItems;
                $order_item->order_id = $order->id;
                $order_item->product_id = $item['product_id'];
                $order_item->price = $item['price'];
                $order_item->amount = $item['amount'];
                $order_item->save();
            }

            Cart::where('user_id',Auth::id())->delete();

            DB::commit();
            // dd(OrderItems::
            // where("order_items.order_id",$order->id)
            // ->get());
            // dd($order->id);
            // $order_items = OrderItems::where("order_id",$order->id)->get();
            $order_items = OrderItems::select('products.name', 'order_items.price', 'order_items.amount', 'sizes.size', 'color.color')
                    ->join('product_details', 'order_items.product_id', '=', 'product_details.id')
                    ->join('products', 'product_details.product_id', '=', 'products.id')
                    ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
                    ->join('color', 'product_details.color_id', '=', 'color.id')
                    ->where("order_items.order_id",$order->id)
                    ->get();
            // dd($order_items);
            Mail::to(Auth::user()->email)->send(new CustomerMail($order_items));
            Mail::to("admin@admin.com")->send(new AdminMail($order_items));


        } catch (\Exception $e) {
            $error = $e->getMessage();

            if(isset($error)){
                DB::rollback();
                return view('carts.stockout');
            }
        }


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

    public function success(){
        echo '決済成功';
    }

    public function cancel(){
        echo 'キャンセル';
    }

}

