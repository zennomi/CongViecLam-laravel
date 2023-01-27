<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\Http\Controllers\TranslationController;


Route::middleware(['auth:admin', 'set_lang'])->prefix('admin/settings')->group(function () {
    Route::prefix('languages/')->group(function () {
        // translation form show
        Route::get('/get/{code}', [TranslationController::class, 'langView'])->name('languages.view');

        // translation form submit
        Route::post('translation/update', [TranslationController::class, 'transUpdate'])->name('translation.update');
        Route::post('auto/translation/single', [TranslationController::class, 'autoTransSingle'])->name('translation.update.auto');
    });

    // language crud
    Route::resource('languages', LanguageController::class);
    Route::put('languages/default', [TranslationController::class, 'setDefaultLanguage'])->name('setDefaultLanguage');
});

// set language
Route::get('change-language/{lang}', [TranslationController::class, 'changeLanguage'])->name('changeLanguage');
