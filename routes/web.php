<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::post('/seller/shop', [SellerController::class, 'seller_request'])->name('seller.request');
