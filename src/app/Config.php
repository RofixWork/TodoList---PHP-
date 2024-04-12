<?php

namespace App;
/**
 * @property-read array $config
 */
class Config
{
    private array $config;

    public function __construct(array $configuration)
    {
       $this->config = $configuration;
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}