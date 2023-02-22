<?php

return [

    'default' => env('FIREBASE_CONNECTION', 'main'),

    'connections' => [
        'main' => [
            'url' => env('FIREBASE_DATABASE_URL'),
            'credentials' => env('FIREBASE_CREDENTIALS'),
            'cache_store' => env('FIREBASE_CACHE_DRIVER', 'file'),
            'cache_prefix' => 'firebase:',
            'timeout' => 10.0,
        ],
    ],
    
];