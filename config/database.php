<?php
return [
    'default' => 'mysql',
    
    'max_connections__count' => 10,
    
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'database' => 'merchant_backend',
            'host' => '172.16.10.142',
            'port' => 3306,
            'username' => 'tester',
            'password' => 'Huliao.123',
            'charset' => 'utf8mb4',
            'prefix' => '',
        ],
    ]
];