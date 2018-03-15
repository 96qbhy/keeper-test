<?php
return [
    'default' => 'mysql',
    
    'max_connections_count' => 20,
    
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
        'local_mysql' => [
            'driver' => 'mysql',
            'database' => 'merchant-backend',
            'host' => '127.0.0.1',
            'port' => 3306,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8mb4',
            'prefix' => '',
        ],
    ]
];