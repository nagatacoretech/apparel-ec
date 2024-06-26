<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                $order_item->order_id = (int)$order->id;
                $order_item->product_id = (int)$item['product_id'];
                $order_item->price = (int)$item['price'];
                $order_item->amount =(int)$item['amount'];
                $order_item->save();
            }

            DB::commit();
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

