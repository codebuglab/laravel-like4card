<?php


return [
    /*
    |--------------------------------------------------------------------------
    | Life4Card Default Order Model
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
    | Life4Card auth info
    |--------------------------------------------------------------------------
    |
    | This is your Life4Card info to make auth request.
    |
    */

    'device_id' => env('LIKE4CARD_DEVICE_ID', null),
    'email' => env('LIKE4CARD_EMAIL', null),
    'password' => env('LIKE4CARD_PASSWORD', null),
    'security_code' => env('LIKE4CARD_SECURITY_CODE', null),
    'lang_id' => env('LIKE4CARD_LANG_ID', 1),
];
