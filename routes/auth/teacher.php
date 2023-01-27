<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Teacher\LoginController;
use App\Http\Controllers\Auth\Teacher\DashboardController;

Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::middleware('guest:teacher')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('teacher.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::get('home', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:teacher');
});
