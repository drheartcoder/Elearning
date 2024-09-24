<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [        
        'client_id' => env('PAYPAL_KEY'),
        'secret'    => env('PAYPAL_SECRET'),
    ],

    'facebook' => 
    [
        'client_id'     => '936795189855884',
        'client_secret' => '9197adecb89aa520daeaec22d931f882',
        'redirect'      => env('APP_URL').'/signin/facebook/callback',
    ],

    'twitter' =>
    [
        'client_id'     => '8BjKG3xueVHlkBhXXy6By4AhS',
        'client_secret' => 'U820HZyPFzI03kWVcF5X7mt2aN1laKdImZqzQeRNx8sIcDn7oY',
        'redirect'      => env('APP_URL').'/signin/twitter/callback',
    ],

    'linkedin' =>
    [
        'client_id'     => '81m01kz25880gs',
        'client_secret' => '8DKqHNEXv7zlO2zf',
        'redirect'      => env('APP_URL').'/signin/linkedin/callback',
    ],
    'google' =>
    [
        'client_id'     => '551789191797-1ag5cu97upgn52bpqhv2pcsao0bgrd98.apps.googleusercontent.com',
        'client_secret' => '7iIgrzTLVb548Q8XKpzXpPvI',
        'redirect'      => env('APP_URL').'/signin/google/callback',
    ],
];
