<?php

namespace App;


use App\Exceptions\ViewNotFoundException;

class View
{
    public function __construct(private string $view, private array $params = [])
    {
    }

    /**
     * @throws ViewNotFoundException
     */
    public function render() : string|ViewNotFoundException
    {
        $view_path = VIEW_PATH . "/$this->view.php";

        if(!file_exists($view_path))
            throw new ViewNotFoundException();
        ob_start();
        include $view_path;
        return ob_get_clean();
    }

    public static function make(string $view, array $params = []) : static
    {
        return new static($view, $params);
    }

    /**
     * @throws ViewNotFoundException
     */
    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}