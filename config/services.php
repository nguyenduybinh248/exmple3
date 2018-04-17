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
	'google' => [
		'client_id' => '273130601182-6e34dnms04nh2f8druquckf5kh3k3vmg.apps.googleusercontent.com',
		'client_secret' => 'HQK18OrY6OfGDY-jIkYwB-hX',
		'redirect' => 'http://duybinh.pro/auth/google/callback',
	],
	'facebook' => [
		'client_id' => '1366528240113900',
		'client_secret' => '9d7e85fe99665f94140f748c2e288458',
		'redirect' => 'http://duybinh.pro/auth/facebook/callback',
	],

];
