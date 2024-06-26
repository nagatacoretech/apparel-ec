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

        ]);

        ProductDetail::create([
            'product_id' => $product->id,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            // 'stock' => $request->stock,
        ]);

        return redirect('admin/products');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['ProductDetail.size', 'ProductDetail.color'])->findOrFail($id);
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.products.show', compact('product', 'sizes', 'colors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.products.edit', compact('product', 'sizes', 'colors'));//
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'visibility' => 'required|boolean',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size_id' => 'required|exists:sizes,id',
            'color_id' => 'required|exists:color,id',
        ]);

        $product = Product::findOrFail($id);
        if ($request->hasFile('img_path')) {
            // Store the new image
            $img_path = $request->file('img_path')->store('images', 'public');
        } else {
            $img_path = $product->img_path;
        }


        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'visibility' => $request->visibility,
            'img_path' => $img_path,
        ]);

        $productDetail = $product->productDetail()->firstOrCreate([
            'product_id' => $product->id
        ]);

        $productDetail->update([
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
        ]);

        return redirect('admin/products');//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_to_del = Product::find($id);
        $product_to_del->delete($product_to_del);
        return redirect('admin/');//
    }
}
