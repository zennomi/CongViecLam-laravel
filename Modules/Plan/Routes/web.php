<?php

use Illuminate\Support\Facades\Route;
use Modules\Plan\Http\Controllers\PlanController;

Route::middleware(['auth:admin', 'set_lang'])->group(function () {
    Route::prefix('admin/plan')->name('module.plan.')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('index');
        Route::get('/create', [PlanController::class, 'create'])->name('create');
        Route::post('/store', [PlanController::class, 'store'])->name('store');
        Route::get('/edit/{plan}', [PlanController::class, 'edit'])->name('edit');
        Route::put('/update/{plan}', [PlanController::class, 'update'])->name('update');
        Route::delete('delete/{plan}', [PlanController::class, 'destroy'])->name('delete');
        Route::post('recommended', [PlanController::class, 'markRecommended'])->name('recommended');
        Route::post('default', [PlanController::class, 'markDefault'])->name('default');
    });
});
