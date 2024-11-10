<?php

return [

    'paths' => ['*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*', 'http://localhost:8100', 'http://127.0.0.1:8100'],

    'allowed_origins_patterns' => [
        '/.*/',
    ],

    'allowed_headers' => ['*', 'Authorization', 'authorization', 'Content-Type', 'X-Requested-With'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];