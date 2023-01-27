<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/test', function(){
    return Job::all();
});



include(base_path('routes/admin.php'));
include(base_path('routes/website.php'));
include(base_path('routes/command.php'));
include(base_path('routes/payment.php'));

Route::fallback(function () {
    return view('errors.404');
});

