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

    'google' => [
        'client_id' => '653245736473-n0rfheqp5o0f6dqj55qr1sk90l3i8vi3.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/callback/google',
    ],

    'github' => [
        'client_id'     => 'ej3uCFEG05kVnn8XvuOupbGRq',
        'client_secret' => 'ASBbrS6zaEk2WAdXWDkWXLfkBQChgepxoOrsicvvPYY2nM5PJI',
        'redirect'      => 'http://localhost:8000/auth/github/callback',
    ],

    'facebook' => [
        'client_id' => '890626088268072',
        'client_secret' => 'e67895f1cdece9b5c4be81cfd893a689',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'T1NHS21hT2VWZWl3SDdNa0VLYlA6MTpjaQ',
        'client_secret' => 'BPXQTjYKmdEqztplMcuhvMnlZhyVjBc7k_tFL2KuyQtYoR-a-j',
        'redirect' => 'http://localhost:8000/auth/twitter/callback',
    ]

];
