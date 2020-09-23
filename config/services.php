<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    //...
    'facebook' => [
        'client_id'     => '731912474289880',
        'client_secret' => '0931f91258f19a9ba7906e655fda0d7d',
        'redirect'      => 'https://onlinemariners.com/signin/facebook/callback',
    ],
    
    'google' => [
        'client_id'     => '17603459449-l7o5oen2v049aeiounho21d1pnbmilhd.apps.googleusercontent.com',
        'client_secret' => '6vD41S30Qi6hIoh36zcwY-v3',
        'redirect'      => 'https://onlinemariners.com/signin/google/callback',
    ],

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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],


];
