<?php

namespace App;

use PDO;

/**
 * @mixin PDO
 */
class DB
{
    private static PDO $pdo;
    public function __construct(Config $config)
    {
        try {
            static::$pdo = new PDO("mysql:host=$config->host;dbname=$config->dbname", $config->username, $config->password, [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (\PDOException $exception)
        {
            throw new \PDOException($exception->getMessage(), $exception->getCode());
        }
    }

    public static function getConnection() : PDO
    {
        return static::$pdo;
    }

}