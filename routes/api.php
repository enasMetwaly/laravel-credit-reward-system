<?php

use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\RedemptionController;
use App\Http\Controllers\Api\ProductController;

use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login'])->name('login');
    Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');

    // Credit Packages & Purchases
    Route::get('/credit-packages', [PurchaseController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/purchase', [PurchaseController::class, 'store'])->middleware('auth:sanctum');

    // Points Redemption
    Route::get('/redeemable-products', [RedemptionController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/redeem-product', [RedemptionController::class, 'store'])->middleware('auth:sanctum');

});
// Product Search Endpoint
Route::get('/products/search', [ProductController::class, 'search']);
Route::post('/products/ai/recommendation', [ProductController::class, 'recommend']);