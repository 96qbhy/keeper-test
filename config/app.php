<?php

use App\Database\DatabaseModule;

return [
    'modules' => [
        DatabaseModule::class,
    ],
    'log' => [
        'path' => __DIR__ . '/../temp/app.log',
    ]
];