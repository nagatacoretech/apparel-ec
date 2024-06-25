<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/carts/index',[CartController::class,'add_index'])->name('cart.index');
    Route::post('/cart/store',[CartController::class,'add_cart'])->name('add_cart');
    Route::post('/cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');
});

require __DIR__.'/auth.php';
