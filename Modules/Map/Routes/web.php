<?php

use Illuminate\Support\Facades\Route;
use Modules\Map\Http\Controllers\MapController;

Route::middleware(['auth:admin', 'set_lang'])->group(function () {
    // Map
    Route::prefix('admin/map')->group(function () {
        Route::get('/', [MapController::class, 'index'])->name('module.map.index');
        Route::put('/update', [MapController::class, 'update'])->name('module.map.update');
    });
});
