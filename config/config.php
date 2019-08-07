<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Auth Credentials
    |--------------------------------------------------------------------------
    |
    */
    'client_id' => env('SABRE_CLIENT_ID'),
    'client_secret'  => env('SABRE_CLIENT_SECRET'),
    'pseudo_city_code' => env('SABRE_PSEUDO_CITY_CODE'),
    'dev_mode' => env('SABRE_DEV_MODE', false),

    /*
    |--------------------------------------------------------------------------
    | API defaults
    |--------------------------------------------------------------------------
    |
    */
    'defaults' => [
        'base_uri' => env('SABRE_BASE_URL', 'https://api.havail.sabre.com/'),
        'verify' => env('SABRE_API_VERIFY', true),
    ],
];
