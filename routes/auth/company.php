<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Company\LoginController;
use App\Http\Controllers\Auth\Company\DashboardController;


Route::prefix('company')->name('company.')->group(function () {
    Route::middleware('guest:company')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('company.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::get('home', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:company');
});
