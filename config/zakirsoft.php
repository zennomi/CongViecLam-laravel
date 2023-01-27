<?php

/*
 * This file is part of the Laravel Rave package.
 *
 * (c) Zakirsoft.com - Zakir Hossen <zakirsoft20@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'default_language' => env('APP_DEFAULT_LANGUAGE'),
    'timezone' => env('APP_TIMEZONE'),
    'currency' => env('APP_CURRENCY'),
    'currency_symbol' => env('APP_CURRENCY_SYMBOL'),
    'currency_symbol_position' => env('APP_CURRENCY_SYMBOL_POSITION'),

    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
    'stripe_active' => env('STRIPE_ACTIVE'),

    'razorpay_key' => env('RAZORPAY_KEY'),
    'razorpay_secret' => env('RAZORPAY_SECRET'),
    'razorpay_active' => env('RAZORPAY_ACTIVE'),

    'paystack_key' => env('PAYSTACK_PUBLIC_KEY'),
    'paystack_secret' => env('PAYSTACK_SECRET_KEY'),
    'paystack_payment_url' => env('PAYSTACK_PAYMENT_URL'),
    'paystack_merchant' => env('MERCHANT_EMAIL'),
    'paystack_active' => env('PAYSTACK_ACTIVE'),

    'ssl_id' => env('STORE_ID'),
    'ssl_pass' => env('STORE_PASSWORD'),
    'ssl_active' => env('SSLCOMMERZ_ACTIVE'),
    'ssl_mode' => env('SSLCOMMERZ_MODE', 'sandbox'),

    'flw_public_key' => env('FLW_PUBLIC_KEY'),
    'flw_secret' => env('FLW_SECRET_KEY'),
    'flw_secret_hash' => env('FLW_SECRET_HASH'),
    'flw_active' => env('FLW_ACTIVE'),

    'im_key' => env('IM_API_KEY'),
    'im_secret' => env('IM_AUTH_TOKEN'),
    'im_url' => env('IM_URL'),
    'im_active' => env('IM_ACTIVE'),

    'midtrans_merchat_id' => env('MIDTRANS_MERCHAT_ID'),
    'midtrans_client_key' => env('MIDTRANS_CLIENT_KEY'),
    'midtrans_server_key' => env('MIDTRANS_SERVER_KEY'),
    'midtrans_active' => env('MIDTRANS_ACTIVE'),

    'mollie_key' => env('MOLLIE_KEY'),
    'mollie_active' => env('MOLLIE_ACTIVE'),

    'google_id' => env('GOOGLE_CLIENT_ID'),
    'google_secret' => env('GOOGLE_CLIENT_SECRET'),
    'google_active' => env('GOOGLE_LOGIN_ACTIVE'),

    'twitter_id' => env('TWITTER_CLIENT_ID'),
    'twitter_secret' => env('TWITTER_CLIENT_SECRET'),
    'twitter_active' => env('TWITTER_LOGIN_ACTIVE'),

    'facebook_id' => env('FACEBOOK_CLIENT_ID'),
    'facebook_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'facebook_active' => env('FACEBOOK_LOGIN_ACTIVE'),

    'linkedin_id' => env('LINKEDIN_CLIENT_ID'),
    'linkedin_secret' => env('LINKEDIN_CLIENT_SECRET'),
    'linkedin_active' => env('LINKEDIN_LOGIN_ACTIVE'),

    'github_id' => env('GITHUB_CLIENT_ID'),
    'github_secret' => env('GITHUB_CLIENT_SECRET'),
    'github_active' => env('GITHUB_LOGIN_ACTIVE'),

    'google_analytics' => env('GOOGLE_ANALYTICS_ID'),

    'indeed_id' => env('INDEED_ID'),
    'indeed_limit' => env('INDEED_LIMIT'),
    'indeed_active' => env('INDEED_ACTIVE'),

    'careerjet_id' => env('CARRERJET_ID'),
    'careerjet_default_locale' => env('CARRERJET_DEFAULT_LOCALE'),
    'careerjet_limit' => env('CARRERJET_LIMIT'),
    'careerjet_active' => env('CARRERJET_ACTIVE'),
];
