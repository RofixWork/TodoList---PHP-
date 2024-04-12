<?php

namespace App;

use App\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;
use ReflectionException;

class Container implements ContainerInterface
{
    private array $entries;

    /**
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function get(string $id)
    {
        if($this->has($id))
        {
            $entry = $this->entries[$id];
            return $entry($this);
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concret) : void
    {
        $this->entries[$id] = $concret;
    }

    /**
     * @throws  ReflectionException
     * @throws ContainerException
     */
    public function resolve(string $id)
    {
        $reflectionClass = new \ReflectionClass($id);
        if(!$reflectionClass->isInstantiable())
        {
            throw new ContainerException("The class $id cannot instantiable");
        }

        $constructor = $reflectionClass->getConstructor();

        if(!$constructor)
        {
            return new $id;
        }

        $params = $constructor->getParameters();

        if(!$params)
        {
            return new $id;
        }

        $arguments = array_map(function (\ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if(!$type)
            {
                throw new ContainerException('Failed to resolve class ' . $id . 'because $params ' . $name . ' is missing a type hint');
            }

            if($type instanceof \ReflectionUnionType)
            {
                throw new ContainerException("cannot use a param union type");
            }

            if($type instanceof \ReflectionNamedType && !$type->isBuiltin())
            {
                return $this->get($type->getName());
            }
            throw new ContainerException('Failed to resolve class ' . $id . 'because $params ' . $name . ' is missing a type hint');

        }, $params);

        return $reflectionClass->newInstanceArgs($arguments);
    }
}