<?php

use Illuminate\Support\Facades\Route;
use Modules\Faq\Http\Controllers\FaqCategoryController;
use Modules\Faq\Http\Controllers\FaqController;

Route::middleware(['auth:admin','set_lang'])->group(function () {
    // Faq Routes
    Route::prefix('admin/faq')->group(function () {
        Route::get('/add', [FaqController::class, 'create'])->name('module.faq.create');
        Route::get('/{slug?}', [FaqController::class, 'index'])->name('module.faq.index');
        Route::post('/add', [FaqController::class, 'store'])->name('module.faq.store');
        Route::get('/edit/{faq}', [FaqController::class, 'edit'])->name('module.faq.edit');
        Route::put('/update/{faq}', [FaqController::class, 'update'])->name('module.faq.update');
        Route::delete('/destroy/{faq}', [FaqController::class, 'destroy'])->name('module.faq.destroy');
    });

    // Faq Category Routes
    Route::prefix('admin/faqcategory')->group(function () {
        Route::get('/', [FaqCategoryController::class, 'index'])->name('module.faq.category.index');
        Route::get('/add', [FaqCategoryController::class, 'create'])->name('module.faq.category.create');
        Route::post('/add', [FaqCategoryController::class, 'store'])->name('module.faq.category.store');
        Route::get('/edit/{faq_category}', [FaqCategoryController::class, 'edit'])->name('module.faq.category.edit');
        Route::put('/update/{faq_category}', [FaqCategoryController::class, 'update'])->name('module.faq.category.update');
        Route::delete('/destroy/{faq_category}', [FaqCategoryController::class, 'destroy'])->name('module.faq.category.destroy');
        Route::post('/update/order', [FaqCategoryController::class, 'updateOrder'])->name('module.faq.category.updateOrder');
    });
});
