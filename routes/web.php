<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PurchaseController;

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
    Route::post('/cart/increase/{id}',[CartController::class,'increase'])->name('increase');
    Route::post('/cart/decrease/{id}',[CartController::class,'decrease'])->name('decrease');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::post('/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
    Route::get('/show/{id}',[ItemController::class,'show'])->name('item.show');
    Route::post('purchase/checkout', [PurchaseController::class,'purchase'])->name('purchase');
    Route::get('purchase/stockout', [PurchaseController::class,'purchase'])->name('stockout');
    Route::get('/stripe/success', [PurchaseController::class, 'success'])->name('success');
    Route::get('/stripe/cancel', [PurchaseController::class, 'cancel'])->name('cancel');



});

require __DIR__.'/auth.php';
