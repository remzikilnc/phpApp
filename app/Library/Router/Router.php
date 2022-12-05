<?php

namespace App\Library\Router;

class Router extends BaseRouter
{

    public function getRoute($routeName): int|string|array
    {
        if (isset($routeName)){
            return $this->routes[$routeName];
        }else return key($this->routes);
    }
}