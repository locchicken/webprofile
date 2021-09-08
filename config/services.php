<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '5755002361240876',  //client face của bạn
        'client_secret' => 'bf27c7c1cfc6585adc60102967ace2f7',  //client app service face của bạn
        'redirect' => 'http://localhost/locdz/login/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '1038796877946-ri6qvgr5v00tb98ds1ao354t503mo4u6.apps.googleusercontent.com',
        'client_secret' => 'DNvrJOSUf1dUYidepI9tS4XR',
        'redirect' => 'http://localhost/locdz/login/google'
    ],


];
