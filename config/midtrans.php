<?php

return  [
    'serverKey' => env('MIDTRANS_SERVER_KEY'),
    'clientKey' => env('MIDTRANS_CLIENT_KEY'),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION'),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED'),
    'is3ds' => env('MIDTRANS_IS_3DS'),
    'isDev' => env('MIDTRANS_IS_DEV'),
    'isLog' => env('MIDTRANS_IS_LOG'),
    'isLogPath' => env('MIDTRANS_IS_LOG_PATH'),
    'isCurl' => env('MIDTRANS_IS_CURL'),
    'isCurlPath' => env('MIDTRANS_IS_CURL_PATH'),
    'isCurlOption' => env('MIDTRANS_IS_CURL_OPTION'),
    'isCurlOptionPath' => env('MIDTRANS_IS_CURL_OPTION_PATH'),
];