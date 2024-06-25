<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use App\Models\ParentCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $womanCategory = $request->input('woman_category');
        $manCategory = $request->input('man_category');

        if ($request->filled('woman_category')) {
            $products = Product::select('products.id', 'products.name', 'child_categories.name as category_name', 'products.img_path', 'products.price')
                    ->join('child_categories', 'products.child_category_id', '=', 'child_categories.id')
                    ->where('child_categories.name', $womanCategory)
                    ->where('child_categories.gender', 2)
                    ->where('visibility', 1)
                    ->get();
        } elseif ($request->filled('man_category')) {
            $products = Product::select('products.id', 'products.name', 'child_categories.name as category_name', 'products.img_path', 'products.price')
                    ->join('child_categories', 'products.child_category_id', '=', 'child_categories.id')
                    ->where('child_categories.name', $manCategory)
                    ->where('child_categories.gender', 1)
                    ->where('visibility', 1)
                    ->get();
        } else {
            $products = Product::select('id', 'name', 'img_path', 'price')
            ->where('name', 'like', '%'.$query.'%')
            ->where('visibility', 1)
            ->get();
        }

        return view('items.results', compact("products"));
    }

    public function index()
    {
        $parent_categories = ParentCategory::all();
        $child_categories = ChildCategory::all();
        //dd($parent_categories,$child_categories);
        return view('layouts.navigation', compact('parent_categories', 'child_categories'));
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
