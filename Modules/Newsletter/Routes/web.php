<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\Http\Controllers\NewsletterController;


Route::middleware(['auth:admin', 'set_lang'])->prefix('admin/newsletter')->group(function () {

    Route::get('/', [NewsletterController::class, 'index'])->name('module.newsletter.index');
    Route::delete('/delete/{email}', [NewsletterController::class, 'destroy'])->name('module.newsletter.delete');
    Route::get('/send-mail', [NewsletterController::class, 'sendMail'])->name('module.newsletter.send_mail');
    Route::post('/send-mail', [NewsletterController::class, 'submitMail'])->name('module.newsletter.submit_mail');
});
// store email from frontend user
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
