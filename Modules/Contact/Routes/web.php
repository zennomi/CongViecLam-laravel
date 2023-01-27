<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactController;

Route::post('contact/add', [ContactController::class, 'store'])->name('module.contact.store');
