<?php

namespace System\Core\Router;

use App\Library\Response\JsonResponse;
use App\Library\Router\BaseRouter;


class Router extends BaseRouter
{
    public static ?Router $instance = null;

    private JsonResponse $commandResponse;


    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Router|null
     */
    public static function getInstance(): Router|null
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setParams($params)
    {
        $this->setPaths($params);
        $this->loadCache();
    }


    /*
    public function getRoute($routeName)
    {
        if (isset($routeName)){
            return $this->routes[$routeName];
        }else return $this->exception('There is no route with this name.');

    }
    */

}