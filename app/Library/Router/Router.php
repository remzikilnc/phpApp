<?php

namespace App\Library\Router;

use Exception;

class Router extends BaseRouter
{
    public static $instance = null;

    public static function getInstance(){
            if (null === self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function getRoute($routeName)
    {
        if (isset($routeName)){
            return $this->routes[$routeName];
        }else return $this->exception('There is no route with this name.');

    }
}