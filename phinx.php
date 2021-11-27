<?php

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'production' => [
                'adapter' => 'mysql',
                'host' => 'localhost',
                'name' => 'my_web',
                'user' => 'root',
                'pass' => '',
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => 'mysql',
                'host' => 'localhost',
                'name' => 'dev_my_web',
                'user' => 'izzat',
                'pass' => 'abc123',
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'development_n' => [
                'adapter' => 'mysql',
                'host' => 'localhost',
                'name' => 'web',
                'user' => 'root',
                'pass' => 'admin123',
                'port' => '3306',
                'charset' => 'utf8',
            ],
            'testing' => [
                'adapter' => 'mysql',
                'host' => 'localhost',
                'name' => 'testing_db',
                'user' => 'root',
                'pass' => '',
                'port' => '3306',
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
