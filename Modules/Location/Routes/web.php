<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Http\Controllers\CityController;
use Modules\Location\Http\Controllers\TownController;
use Modules\Location\Http\Controllers\CountryController;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\City;
use Modules\Location\Http\Controllers\StateController;

Route::middleware(['auth:admin', 'set_lang'])->group(function () {

    // Country CRUD
    Route::prefix('admin/country')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('module.country.index');
        Route::get('create', [CountryController::class, 'create'])->name('module.country.create');
        Route::post('store', [CountryController::class, 'store'])->name('module.country.store');
        Route::get('edit/{country}', [CountryController::class, 'edit'])->name('module.country.edit');
        Route::put('update/{country}', [CountryController::class, 'update'])->name('module.country.update');
        Route::delete('delete/{country}', [CountryController::class, 'destroy'])->name('module.country.delete');
        Route::delete('multiple/delete', [CountryController::class, 'multipleDestroy'])->name('module.country.multiple.delete');
        Route::post('/set/app/country', [CountryController::class, 'setAppCountry'])->name('module.set.app.country');
    });


    //State CRUD
    Route::prefix('admin/state')->group(function () {
        Route::get('/', [StateController::class, 'index'])->name('module.state.index');
        Route::get('create', [StateController::class, 'create'])->name('module.state.create');
        Route::post('store', [StateController::class, 'store'])->name('module.state.store');
        Route::get('edit/{state}', [StateController::class, 'edit'])->name('module.state.edit');
        Route::put('update/{state}', [StateController::class, 'update'])->name('module.state.update');
        Route::delete('delete/{state}', [StateController::class, 'destroy'])->name('module.state.delete');
        Route::post('state/get/country', [StateController::class, 'getCountry'])->name('module.state.country');
        Route::delete('multiple/delete', [StateController::class, 'multipleDestroy'])->name('module.state.multiple.delete');
    });


    //City CRUD
    Route::prefix('admin/city')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('module.city.index');
        Route::get('create', [CityController::class, 'create'])->name('module.city.create');
        Route::post('store', [CityController::class, 'store'])->name('module.city.store');
        Route::get('edit/{city}', [CityController::class, 'edit'])->name('module.city.edit');
        Route::put('update/{city}', [CityController::class, 'update'])->name('module.city.update');
        Route::delete('delete/{city}', [CityController::class, 'destroy'])->name('module.city.delete');
        Route::post('city/get/state', [CityController::class, 'getState'])->name('module.city.state');
        Route::delete('multiple/delete', [CityController::class, 'multipleDestroy'])->name('module.city.multiple.delete');
    });
});

Route::get('/get-towns/{city_id}', [CityController::class, 'getTowns']);
