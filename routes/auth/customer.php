<?php

use App\Http\Controllers\Auth\Customer\DashboardController;
use App\Http\Controllers\Auth\Customer\LoginController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\Customer\LoginController;
// use App\Http\Controllers\Auth\Customer\DashboardController;

Route::prefix('customer')->name('customer.')->group(function () {
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('customer.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::get('home', [DashboardController::class, 'index'])->name('dashboard');
});
