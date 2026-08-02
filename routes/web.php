<?php

use App\Http\Controllers\Frontend\AddToCart;
use App\Http\Controllers\Frontend\BuyingHistoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/categories', [PageController::class, 'categories'])->name('categories');

Route::get('/products', [PageController::class, 'products'])->name('products');

Route::get('/product/{id}', [PageController::class, 'product'])->name('product');

Route::get('/seller-form', [SellerController::class, 'index'])->name('seller.index');

Route::post('/seller/shop', [SellerController::class, 'seller_request'])->name('seller.request');

Route::post('/cart/store', [AddToCart::class, 'addtocart'])->name('cart.store');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout/seller/{id}', [CheckoutController::class, 'checkout'])->name('checkout.seller');
    Route::post('/order/store/{id}', [CheckoutController::class, 'store'])->name('order.store');
    Route::get('/khalti/callback/{id}', [CheckoutController::class, 'khalti_callback'])->name('khalti.callback');

    Route::get('/buying-history', [BuyingHistoryController::class, 'index'])->name('buying-history');
    Route::get('/buying-history/{order}', [BuyingHistoryController::class, 'show'])->name('buying-history.show');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
