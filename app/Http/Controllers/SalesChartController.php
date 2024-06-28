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
        // $monthlySales = DB::table('orders')
        //     ->selectRaw('DATE_FORMAT(created_at, "%Y") as Year, DATE_FORMAT(created_at, "%m") as Month, SUM(total_price) as total_sales')
        //     ->groupByRaw('DATE_FORMAT(created_at, "%Y"), DATE_FORMAT(created_at, "%m")')
        //     ->orderByRaw('DATE_FORMAT(created_at, "%Y")')
        //     ->get();
        $monthlySales = DB::table('orders')
            ->selectRaw('YEAR(created_at) as Year, MONTH(created_at) as Month, COALESCE(SUM(total_price), 0) as total_sales')
            ->rightJoin(DB::raw('(SELECT 1 as m UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months'), function ($join) {
                $join->on(DB::raw('MONTH(created_at)'), '=', 'months.m');
            })
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
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

        $yearly_members = DB::table('users')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as year,count(*) as members')
            ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m")')
            ->orderByRaw('DATE_FORMAT(created_at, "%Y-%m")')
            ->get();
        $labels = $yearly_members->pluck('year')->toArray();
        $data = $yearly_members->pluck('members')->toArray();

        return view('admin.sales_chart.index',compact("monthlySales","yearlySales","stockout","total_members","labels","data"));
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
