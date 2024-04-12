<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class Application
{
    private static DB $pdo;
    public function __construct(private Router $router, private array $requestInfo, private Config $config)
    {
        static::$pdo = new DB($this->config);
    }

    public function run() : void
    {
        try {
            echo $this->router->resolve($this->requestInfo['uri'], strtolower($this->requestInfo['method']));
        } catch (RouteNotFoundException $ex)
        {
            echo $ex->getMessage();
        }

    }

    public static function db() : \PDO
    {
        return DB::getConnection();
    }
}