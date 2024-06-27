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
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        DB::beginTransaction();
        try {
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

            // Cart::where('user_id',Auth;;)->
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
                dd($error);
                // return view();
            }
        }
        return view('purchase.checkout');
    }

    public function checkout()
    {

        return view('purchase.checkout');
    }
}

