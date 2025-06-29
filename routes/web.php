<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.auth.login')->middleware('guest:admin');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.auth.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard'); // Use 'auth' instead of 'admin'
});