<?php
return [
    'default' => 'mysql',

    'connections' => [
        'mysql'       => [
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => 'keeper-test',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
        ],
    ]
];