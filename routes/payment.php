<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\MollieController;
use App\Http\Controllers\Payment\PayPalController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\MidtransController;
use App\Http\Controllers\Payment\PaystackController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\Payment\InstamojoController;
use App\Http\Controllers\Payment\FlutterwaveController;
use App\Http\Controllers\Payment\ManualPaymentController;
use App\Http\Controllers\Payment\SslCommerzPaymentController;

//Paypal
Route::controller(PayPalController::class)->group(function () {
    Route::post('paypal/payment', 'processTransaction')->name('paypal.post');
    Route::get('success-transaction/{plan_id}/{amount}', 'successTransaction')->name('paypal.successTransaction');
    Route::get('cancel-transaction', 'cancelTransaction')->name('paypal.cancelTransaction');
});

// Paystack
Route::controller(PaystackController::class)->group(function () {
    Route::post('paystack/payment', 'redirectToGateway')->name('paystack.post');
    Route::get('/paystack/success', 'successPaystack')->name('paystack.success');
});

// SSLCOMMERZ
Route::controller(SslCommerzPaymentController::class)->prefix('payment')->group(function () {
    Route::post('/pay-via-ajax', 'payViaAjax')->name('ssl.pay');
    Route::post('/ssl/success', 'success');
    Route::post('/ssl/fail', 'fail');
    Route::post('/ssl/cancel', 'cancel');
    Route::post('/ssl/ipn', 'ipn');
});

// Flutterwave
Route::controller(FlutterwaveController::class)->group(function () {
    Route::post('/flutterwave/pay', 'initialize')->name('flutterwave.pay');
    Route::get('/rave/callback', 'callback')->name('flutterwave.callback');
});

// Stripe
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// Razorpay
Route::post('payment', [RazorpayController::class, 'payment'])->name('razorpay.post');

// Paystack
Route::post('paystack/payment', [PaystackController::class, 'redirectToGateway'])->name('paystack.post');
Route::get('/paystack/success', [PaystackController::class, 'successPaystack'])->name('paystack.success');

// Instamojo
Route::controller(InstamojoController::class)->group(function () {
    Route::post('/instamojo/pay', 'pay')->name('instamojo.pay');
    Route::get('/instamojo/success', 'success')->name('instamojo.success');
});

// Mollie
Route::post('mollie-paymnet', [MollieController::class, 'preparePayment'])->name('mollie.payment');
Route::get('mollie-success', [MollieController::class, 'paymentSuccess'])->name('mollie.success');

// Midtrans
Route::post('/midtrans/success', [MidtransController::class, 'success'])->name('midtrans.success');

// Manual Payment
Route::controller(ManualPaymentController::class)->group(function () {
    Route::post('/manual/payment', 'paymentPlace')->name('manual.payment');
    Route::get('/manual/payment/{order}/mark-paid', 'markPaid')->name('manual.payment.mark.paid');
    // Route::get('/instamojo/success', 'success')->name('instamojo.success');
});
