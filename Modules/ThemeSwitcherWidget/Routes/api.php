<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('set-theme-color', function (Request $request) {
    $request->session()->put('key', 'value');
    return [$request->variable, $request->color];
    $request->session()->put($request->variable, $request->color);

    return 'success';
});
