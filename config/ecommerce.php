<?php

return [

    /*
    |--------------------------------------------------------------------------
    | iPay88 Credentials
    |--------------------------------------------------------------------------
    */

    'ipay88' => [
        'code' => env('IPAY_CODE', 'PH00486'),
        'key' => env('IPAY_KEY', '0B70NXZUHt'),
        'gateway' => env('IPAY_GATEWAY', 'https://sandbox.ipay88.com.ph/epayment/entry.asp'),
    ],
];
