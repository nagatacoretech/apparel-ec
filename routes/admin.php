<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesChartController;
use Illuminate\Support\Facades\Route;

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
    Route::get("/",[SalesChartController::class,"index"])->name("dashboard");
    Route::get("/stockout",[SalesChartController::class,"stockout"])->name("stockout");
});

require __DIR__.'/adminAuth.php';
