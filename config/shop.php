<?php

return [
    'currency' => env('SHOP_CURRENCY', 'USD'),
    'currency_symbol' => env('SHOP_CURRENCY_SYMBOL', '$'),
    'shipping_fee' => (float) env('SHOP_SHIPPING_FEE', 5.99),
    'payment_note' => 'Pay securely with PayPal. Your order is confirmed only after payment succeeds.',
];
