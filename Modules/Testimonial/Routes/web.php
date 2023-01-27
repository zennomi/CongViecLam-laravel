<?php

use Illuminate\Support\Facades\Route;
use Modules\Testimonial\Http\Controllers\TestimonialController;

Route::middleware(['auth:admin', 'set_lang'])->group(function () {
    // Testimonial Routes
    Route::prefix('admin/testimonial')->name('module.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('testimonial.index');
        Route::get('/add', [TestimonialController::class, 'create'])->name('testimonial.create');
        Route::post('/add', [TestimonialController::class, 'store'])->name('testimonial.store');
        Route::get('/edit/{testimonial}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
        Route::put('/update/{testimonial}', [TestimonialController::class, 'update'])->name('testimonial.update');
        Route::delete('/destroy/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');
    });
});
