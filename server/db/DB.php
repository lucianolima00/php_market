<?php

namespace App\db;

use PDO;
use PDOException;

/**
 * @mixin PDO
 */
class DB
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        try {
            if (!empty($config)) {
                $this->pdo = new PDO(
                    "pgsql:host=" . $config['database']['host'] . ";port=" . $config['database']['port'] . ";dbname=" . $config['database']['dbname'],
                    $config['database']['username'],
                    $config['database']['password'],
                    $config['database']['options']
                );
            } else {
                $this->pdo = new PDO('');
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}