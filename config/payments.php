<?php

return [
    /*
    | Default payment driver (interface binding).
    | Swap later to stripe, etc. without changing controllers.
    */
    'default' => env('PAYMENT_DRIVER', 'paypal'),

    'currency' => env('SHOP_CURRENCY', 'USD'),

    'paypal' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'), // sandbox|live
        'client_id' => env('PAYPAL_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', ''),
        'base_url' => env('PAYPAL_MODE', 'sandbox') === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com',
    ],
];
