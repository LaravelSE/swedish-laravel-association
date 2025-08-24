<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Stripe API Keys
    |--------------------------------------------------------------------------
    |
    | The Stripe publishable key and secret key give you access to Stripe's
    | API. The "publishable" key is typically used when interacting with
    | Stripe.js while the "secret" key accesses private API endpoints.
    |
    */
    'key' => env('STRIPE_KEY', ''),
    'secret' => env('STRIPE_SECRET', ''),
    'webhook' => [
        'secret' => env('STRIPE_WEBHOOK_SECRET', ''),
        'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Flags
    |--------------------------------------------------------------------------
    |
    | These flags control which features are enabled in the application.
    |
    */
    'features' => [
        'subscriptions' => env('STRIPE_ENABLE_SUBSCRIPTIONS', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Stripe Product Configuration
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the membership product in Stripe.
    |
    */
    'membership' => [
        'price_id' => env('STRIPE_MEMBERSHIP_PRICE_ID', ''),
    ],
];
