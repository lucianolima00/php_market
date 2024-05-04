<?php

namespace App\db;

use PDO;

class Connection
{
    public static function connect()
    {
        $config = require 'config.php';

        $pdo = new PDO(
            "pgsql:host=" . $config['database']['host'] . ";port=" . $config['database']['port'] . ";dbname=" . $config['database']['dbname'],
            $config['database']['username'],
            $config['database']['password'],
            $config['database']['options']
        );

        return $pdo;
    }
}