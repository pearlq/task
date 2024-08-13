<?php

namespace core;

class Router
{
    private array $routes = [];

    public function add($route, $callback): void
    {
        $this->routes[$route] = $callback;
    }

    public function dispatch($request): void
    {
        if (array_key_exists($request, $this->routes)) {
            call_user_func($this->routes[$request]);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo '404 - Страница не найдена';
        }
    }
}