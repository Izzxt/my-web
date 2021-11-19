<?php

namespace Core;

use Exception;
use PDO;
use PDOException;
use Symfony\Component\Dotenv\Dotenv;
use Pixie\Connection;

class DB
{
    public function __construct() {
        
        $env = new Dotenv(true);
        $env->loadEnv(dirname(__DIR__). '/.env');

        $config = [
            'driver'    => getenv('DB_DRIVER'), // Db driver
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USER'),
            'password'  => getenv('DB_PASS'),
            'charset'   => getenv('DB_CHARSET'), // Optional
            'collation' => getenv('DB_COLLATITON'), // Optional
            'prefix'    => getenv('DB_PREFIX'), // Table prefix, optional
            'options'   => [ // PDO constructor options, optional
                PDO::ATTR_TIMEOUT => 5,
                PDO::ATTR_EMULATE_PREPARES => false,
            ],
        ];

        try {
            $con = new Connection('mysql', $config, 'DB');
        }
         catch (PDOException $e) {
          echo "Database Error: The user could not be added.<br>".$e->getMessage();
        } catch (Exception $e) {
          echo "General Error: The user could not be added.<br>".$e->getMessage();
        }
    }
}
