<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Http\Controllers\BlogCategoryController;
use Modules\Blog\Http\Controllers\PostCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // Post Routes
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('module.blog.index');
        Route::get('/add', [BlogController::class, 'create'])->name('module.blog.create');
        Route::post('/add', [BlogController::class, 'store'])->name('module.blog.store');
        Route::get('/edit/{post}', [BlogController::class, 'edit'])->name('module.blog.edit');
        Route::put('/update/{post}', [BlogController::class, 'update'])->name('module.blog.update');
        Route::delete('/destroy/{post}', [BlogController::class, 'destroy'])->name('module.blog.destroy');
    });
    
    Route::prefix('admin/category')->name('module.category.')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
        Route::get('/create', [BlogCategoryController::class, 'create'])->name('create');
        Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [BlogCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [BlogCategoryController::class, 'update'])->name('update');
        Route::delete('delete/{category}', [BlogCategoryController::class, 'destroy'])->name('delete');
    });
});
