<?php

if(env('ipAddressForRedirect') == "admissionx.info"){
    $google_client_id           =   env('GOOGLE_CLIENT_ID_ADXINFO'); 
    $google_client_secret       =   env('GOOGLE_CLIENT_SECRET_ADXINFO'); 
    $google_url                 =   env('GOOGLE_URL_ADXINFO'); 
    $facebook_client_id         =   env('FACEBOOK_CLIENT_ID_ADXINFO'); 
    $facebook_client_secret     =   env('FACEBOOK_CLIENT_SECRET_ADXINFO'); 
    $facebook_url               =   env('FACEBOOK_URL_ADXINFO'); 
}else{
    $google_client_id           =   env('GOOGLE_CLIENT_ID'); 
    $google_client_secret       =   env('GOOGLE_CLIENT_SECRET'); 
    $google_url                 =   env('GOOGLE_URL'); 
    $facebook_client_id         =   env('FACEBOOK_CLIENT_ID'); 
    $facebook_client_secret     =   env('FACEBOOK_CLIENT_SECRET'); 
    $facebook_url               =   env('FACEBOOK_URL'); 
}

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id'     => $google_client_id,
        'client_secret' => $google_client_secret,
        'redirect'      => $google_url,
    ],
    'facebook' => [
        'client_id'     => $facebook_client_id,
        'client_secret' => $facebook_client_secret,
        'redirect'      => $facebook_url,
    ],
];
