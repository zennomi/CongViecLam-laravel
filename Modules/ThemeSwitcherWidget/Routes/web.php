<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('themeswitcherwidget')->group(function() {
    Route::get('/', 'ThemeSwitcherWidgetController@index');
});

Route::get('set-theme-color', function () {
  // dd(session()->all());
  foreach (request()->except('_token') as $key => $part) {
    session([$key => $part ]);
      // request()->session()->put(request()->variable, request()->color);
      // dd([request()->variable => request()->color ]);
    }
    return back();
})->name('set.themeColor');

