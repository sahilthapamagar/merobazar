<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('user.login');
});

Route::get('/products', [PageController::class, 'products'])->name('products');

Route::get('/product/{id}', [PageController::class, 'product'])->name('product');

Route::post('/seller/shop', [SellerController::class, 'seller_request'])->name('seller.request');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
