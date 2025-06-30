<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CreditPackageController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.auth.login')->middleware('guest:admin');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.auth.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Credit Packages
        Route::get('/credit-packages', [CreditPackageController::class, 'index'])->name('admin.credit-packages.index');
        Route::get('/credit-packages/create', [CreditPackageController::class, 'create'])->name('admin.credit-packages.create');
        Route::post('/credit-packages', [CreditPackageController::class, 'store'])->name('admin.credit-packages.store');
        Route::get('/credit-packages/{creditPackage}/edit', [CreditPackageController::class, 'edit'])->name('admin.credit-packages.edit');
        Route::put('/credit-packages/{creditPackage}', [CreditPackageController::class, 'update'])->name('admin.credit-packages.update');
        Route::delete('/credit-packages/{creditPackage}', [CreditPackageController::class, 'destroy'])->name('admin.credit-packages.destroy');

        // Product Catalog
        Route::get('/product-catalog', [ProductController::class, 'index'])->name('admin.product-catalog.index');
        Route::get('/product-catalog/create', [ProductController::class, 'create'])->name('admin.product-catalog.create');
        Route::post('/product-catalog', [ProductController::class, 'store'])->name('admin.product-catalog.store');
        Route::get('/product-catalog/{product}/edit', [ProductController::class, 'edit'])->name('admin.product-catalog.edit');
        Route::put('/product-catalog/{product}', [ProductController::class, 'update'])->name('admin.product-catalog.update');
        Route::delete('/product-catalog/{product}', [ProductController::class, 'destroy'])->name('admin.product-catalog.destroy');
  
    // Redeemable Products
    Route::get('/redeemable-products/create', [AdminDashboardController::class, 'createRedeemableProduct'])->name('admin.redeemable-products.create');
    Route::get('/redeemable-products/{redeemableProduct}/edit', [AdminDashboardController::class, 'editRedeemableProduct'])->name('admin.redeemable-products.edit');
    Route::post('/products/{product}/redeemable', [AdminDashboardController::class, 'storeRedeemableProduct'])->name('admin.redeemable-products.store');
    Route::put('/redeemable-products/{redeemableProduct}', [AdminDashboardController::class, 'updateRedeemableProduct'])->name('admin.redeemable-products.update');
    Route::delete('/redeemable-products/{redeemableProduct}', [AdminDashboardController::class, 'destroyRedeemableProduct'])->name('admin.redeemable-products.destroy');
});