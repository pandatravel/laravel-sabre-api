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
