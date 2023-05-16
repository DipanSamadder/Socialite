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
    'twitter' => [
        'client_id' => 'esbat5GGTYpElmRk5UNjWXONS',
        'client_secret' => 'nR3bUmZy7rLq1MrUQM7gtnTKjz5mlPcVk8tLOX8vUPVbQ5gq1g',
        'redirect' => 'https://socialite.oyeber.com/login/twitter/callback',
    ],
    'instagram' => [
        'client_id' => '3421694774757547',
        'client_secret' => '18a691249e3f851ce23a15c08a722040',
        'redirect' => 'https://socialite.oyeber.com/login/instagram/callback',
    ],
    'instagram' => [  
     'client_id' => env('INSTAGRAM_CLIENT_ID'),  
     'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),  
     'redirect' => env('INSTAGRAM_REDIRECT_URI'),  
],
    'linkedin' => [
        'client_id' => '86akwnu56x1cch',
        'client_secret' => 'dZaykZHs5zM1nTE6',
        'redirect' => 'https://socialite.oyeber.com/login/linkedin/callback',
    ],
    'facebook' => [
        'client_id' => '238845648798106',
        'client_secret' => 'dbf52d000024cde4f67173a08dfc6b53',
        'redirect' => 'https://socialite.oyeber.com/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '686901138003-ob8n48uo20sfropfrm7j6hfgmiupss5m.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://socialite.oyeber.com/login/google/callback',
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'https://socialite.oyeber.com/login/github/callback-url',
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
