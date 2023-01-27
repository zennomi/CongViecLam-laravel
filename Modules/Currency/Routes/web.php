<?php

use Illuminate\Support\Facades\Route;
use Modules\Currency\Http\Controllers\CurrencyController;


Route::group(['as' => 'module.currency.', 'prefix' => 'admin/settings/currency', 'middleware' => ['auth:admin', 'set_lang']], function () {
    Route::get('/', [CurrencyController::class, 'index'])->name('index');
    Route::get('/create', [CurrencyController::class, 'create'])->name('create');
    Route::post('', [CurrencyController::class, 'store'])->name('store');
    Route::get('{currency}/edit', [CurrencyController::class, 'edit'])->name('edit');
    Route::put('{currency}', [CurrencyController::class, 'update'])->name('update');
    Route::post('/default-currency', [CurrencyController::class, 'defaultCurrency'])->name('default');
    Route::delete('{currency}', [CurrencyController::class, 'destroy'])->name('delete');
    Route::get('/example', [CurrencyController::class, 'example'])->name('example');
});
