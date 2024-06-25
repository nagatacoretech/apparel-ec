<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesChartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

Route::get('admin/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('admin.sales_chart.index');
// })->middleware(['auth:admin', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/dashboard",[SalesChartController::class,"index"])->name("dashboard");
    Route::get("/stockout",[SalesChartController::class,"stockout"])->name("stockout");
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/show/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/adminAuth.php';
