<?php

namespace App\Library\Router;

use App\Library\Response\JsonResponse;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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
    
    public function setRequest(Request $request = null)
    {
        $request = $request ?? Request::createFromGlobals();
        $response = $response ?? new Response('', Response::HTTP_OK, ['content-type' => 'application/json']);
        $this->request = new RouterRequest($request, $response);
    }

    public function getRequest(): Request
    {
        return $this->request->symfonyRequest();
    }

    public function setParams($params)
    {
        $this->setPaths($params);
    }

    public function setCommandResponse(JsonResponse $res): JsonResponse
    {
        return $this->commandResponse = $res;
    }

    /**
     * @return JsonResponse
     */
    public function getCommandResponse(): JsonResponse
    {
        return $this->commandResponse;
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