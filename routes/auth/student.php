<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Student\LoginController;
use App\Http\Controllers\Auth\Student\DashboardController;

Route::prefix('student')->name('student.')->group(function () {
    Route::middleware('guest:student')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('student.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::get('home', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:student');
});
