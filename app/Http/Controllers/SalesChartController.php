<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        $monthlySales = DB::table('orders')
            ->selectRaw('DATE_FORMAT(created_at, "%Y") as Year, DATE_FORMAT(created_at, "%m") as Month, SUM(total_price) as total_sales')
            ->groupByRaw('DATE_FORMAT(created_at, "%Y"), DATE_FORMAT(created_at, "%m")')
            ->orderByRaw('DATE_FORMAT(created_at, "%Y")')
            ->get();

        $yearlySales = DB::table('orders')
            ->selectRaw('DATE_FORMAT(created_at, "%Y") as Year, SUM(total_price) as total_sales')
            ->groupByRaw('DATE_FORMAT(created_at, "%Y")')
            ->orderByRaw('DATE_FORMAT(created_at, "%Y")')
            ->get();

        $stockout = DB::table('product_details')
            ->where('stock', 0)
            ->count();

        $total_members = DB::table('users')
            ->count();

        return view('admin.sales_chart.index',compact("monthlySales","yearlySales","stockout","total_members"));
    }

    public function stockout(){
        $stockout_products = DB::table('product_details')
            ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
            ->join('color', 'product_details.color_id', '=', 'color.id')
            ->join('products', 'product_details.product_id', '=', 'products.id')
            ->select('products.id','products.img_path', 'products.name', 'products.price', 'sizes.size', 'color.color')
            ->where('product_details.stock', 0)
            ->get();

            return view('admin.sales_chart.stockout',compact("stockout_products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
