<?php

use Illuminate\Support\Facades\Route;

// ====================Artisan command======================
Route::middleware('auth:admin')->group(function () {
    Route::get('route-clear', function () {
        \Artisan::call('route:clear');
        dd("Route Cleared");
    });

    Route::get('optimize', function () {
        \Artisan::call('optimize');
        dd("Optimized");
    });

    Route::get('optimize-clear', function () {
        \Artisan::call('optimize:clear');

        flashSuccess('Cache cleared successfully');
        return back();
    })->name('app.optimize-clear');

    Route::get('view-clear', function () {
        \Artisan::call('view:clear');
        dd("View Cleared");
    });

    Route::get('view-cache', function () {
        \Artisan::call('view:cache');
        dd("View cleared and cached again");
    });

    Route::get('config-cache', function () {
        \Artisan::call('config:cache');
        dd("configuration cleared and cached again");
    });

    Route::get('config-clear', function () {
        \Artisan::call('config:clear');
        dd("configuration cleared again");
    });

    Route::get('storage-link', function () {
        \Artisan::call('storage:link');
        dd("storage link created");
    });
});
