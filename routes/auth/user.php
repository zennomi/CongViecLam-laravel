<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\User\LoginController;
use App\Http\Controllers\Auth\User\DashboardController;

Route::prefix('users')->name('user.')->group(function () {
    Route::middleware('guest:user')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('users.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::get('home', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:user');
});
