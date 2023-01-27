<?php

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'active' => env('NOCAPTCHA_ACTIVE'),
    'options' => [
        'timeout' => 30,
    ],
];
