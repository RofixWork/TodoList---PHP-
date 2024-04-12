<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router
{
    public array $routes = [];

    public function __construct(private Container $container)
    {
    }

    private function register(string $requestMethod,string $route, callable|array $action) : void
    {
        $this->routes[$requestMethod][$route] = $action;
    }

    public function get(string $route, callable|array $action) : static
    {
        $this->register('get', $route, $action);
        return $this;
    }
    public function post(string $route, callable|array $action) : static
    {
        $this->register('post', $route, $action);
        return $this;
    }

    /**
     * @throws RouteNotFoundException
     * @throws \ReflectionException
     */
    public function resolve(string $requestUri, string $requestMethod) : string|RouteNotFoundException
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if(!$action)
        {
            throw new RouteNotFoundException();
        }


        if(is_callable($action))
        {
            return call_user_func($action);
        }

        [$class, $method] = $action;

        if(class_exists($class))
        {
            $class = $this->container->get($class);

            if(method_exists($class, $method))
            {
                return call_user_func_array([$class, $method], []);
            }
        }
        throw new RouteNotFoundException();
    }
}