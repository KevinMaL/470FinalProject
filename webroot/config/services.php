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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
    'client_id' => '125832994692179',
    'client_secret' => '03f751bd9a1344f45caef8ed0ac6b1e4',
    'redirect' => 'http://localhost:8899/callback/facebook',
    ],

    'twitter' => [
    'client_id' => 'mAcIUotDjyawLKlZcM8TXUuV4',
    'client_secret' => '13SQ3fwKaJ8AZ3jMneH7qNHiLGZMm8RFtqxSgBuSlR5xHSPPvf',
    'redirect' => 'http://localhost:8899/callback/twitter',
    ],

    'google' => [
    'client_id' => '472988831403-ar718msbutq33v72ro8281n342240dbf.apps.googleusercontent.com',
    'client_secret' => 'YDC0tqgVBfQ6GendMc4NCIjR',
    'redirect' => 'http://localhost:8899/callback/google',
    ],

];
