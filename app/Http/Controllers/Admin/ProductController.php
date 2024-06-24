<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductDetail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        $ProductDetail = ProductDetail::all();
        $products = Product::with(['ProductDetail.size', 'ProductDetail.color'])->get();
        return view('admin.products.index', compact('products'));//
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.products.create', compact('sizes', 'colors'));//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'child_category_id' => 'nullable|integer',
            'price' => 'required|integer',
            'visibility' => 'required|boolean',
            'img_path' => 'required||image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|integer',
            'size_id' => 'required|exists:sizes,id',
            'color_id' => 'required|exists:color,id',
        ]);

        $img_path = $request->file('img_path')->store('images', 'public');

        $product = Product::create([
            'name' => $request->name,
            'child_category_id' => $request->child_category_id,
            'price' => $request->price,
            'visibility' => $request->visibility,
            'img_path' => $img_path,
            'stock' => $request->stock,
        ]);

        ProductDetail::create([
            'product_id' => $product->id,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
        ]);

        return redirect('admin/');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['ProductDetail.size', 'ProductDetail.color'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
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
