<?php
use Illuminate\Support\Facades\Route;
use Modules\Seo\Http\Controllers\SeoController;



Route::group(['as' => 'module.seo.','prefix' => 'admin/seo','middleware' => ['auth:admin', 'set_lang']], function () {
    Route::get('/', [SeoController::class, 'index'])->name('index');
    Route::put('/update/{page}', [SeoController::class, 'update'])->name('update');
});
