<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    'base_uri' => env('SABRE_BASE_URL', 'https://api-crt.cert.havail.sabre.com/'),

    'client_id' => env('SABRE_CLIENT_ID'),
    'client_secret'  => env('SABRE_CLIENT_SECRET'),

    'defaults' => [
        'verify' => env('SABRE_API_VERIFY', true),
    ],
];
