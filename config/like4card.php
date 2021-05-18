<?php


return [
    /*
    |--------------------------------------------------------------------------
    | Like4Card Default Order Model
    |--------------------------------------------------------------------------
    |
    | This option defines the default Order model.
    |
    */

    'order' => [
        'model' => 'App\Order'
    ],

    /*
    |--------------------------------------------------------------------------
    | Like4Card auth info
    |--------------------------------------------------------------------------
    |
    | This is your Like4Card info to make auth request.
    |
    */

    'device_id' => env('LIKE4CARD_DEVICE_ID', null),
    'email' => env('LIKE4CARD_EMAIL', null),
    'password' => env('LIKE4CARD_PASSWORD', null),
    'security_code' => env('LIKE4CARD_SECURITY_CODE', null),
    'lang_id' => env('LIKE4CARD_LANG_ID', 1),
];
