<?php

return [
    'cache' => [
        'key' => 'global_meta',
        'duration' => 86400, // In seconds. Default is 1 day
    ],
    'routing' => [
        'admin' => [
            'middlewares' => [],

            'prefix' => '',

            'name_prefix' => '',
        ],
    ],
];
