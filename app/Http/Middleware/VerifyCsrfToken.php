<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'paypal/payment', '/payment/pay-via-ajax', '/payment/ssl/success', '/payment/ssl/cancel', '/payment/ssl/fail', '/payment/ssl/ipn'
    ];
    // protected $except = [
    //     'paypal/payment', '/payment/pay-via-ajax', '/payment/success', '/payment/cancel', '/payment/fail', '/payment/ipn'
    // ];
}
