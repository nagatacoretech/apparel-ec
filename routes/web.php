<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:users', 'verified'])->name('dashboard');

Route::get('/',[ItemController::class,'index'])->name('item.index');
Route::get('/show/{id}',[ItemController::class,'show'])->name('show');
Route::get('/search',[SearchController::class,'search'])->name('search');

Route::middleware('auth:users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/carts/index',[CartController::class,'add_index'])->name('cart.index');
    Route::post('/cart/store',[CartController::class,'add_cart'])->name('add_cart');
    Route::post('/cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
});

require __DIR__.'/auth.php';
