<?php

include_once ROOT_PATH . '/autoload.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}

$http = getHttp();
define('SITE_URL', $http . $_SERVER['HTTP_HOST'] . '/');
define('SITE_PATH', rtrim(ROOT_PATH) . '/');

$loader = new Psr4AutoloaderClass();
$loader->addNamespace('App', '/app');
$loader->addNamespace('Symfony\Component\HttpFoundation', '/app/Library/HttpFoundation');
$loader->addNamespace('Pixie', '/app/Library/QueryBuilder/Pixie');
$loader->addNamespace('Viocon', '/app/Library/QueryBuilder/Viocon');
$loader->register();

\App\Library\Helpers\Config::load(ROOT_PATH . '/Config/config.php');
define("ADMIN_URI", \App\Library\Helpers\Config::get('ADMIN_URI'));

$params = [
    'base_folder' => ROOT_PATH,
    'main_method' => 'main',
    'paths' => [
        'controllers' => 'app/Controller',
        'middlewares' => 'app/Middleware',
    ],
    'namespaces' => [
        'controllers' => 'App\Controller',
        'middlewares' => 'App\Middleware',
    ]
];

$router = \App\Library\Router\Router::getInstance();
$router->setParams($params);

$router->error(function () {
    $response = new \App\Library\Response\JsonResponse();
    $res = $response->setStatusCode(500)
        ->setStatus(false)
        ->setMessage("Invalid Api Method.")
        ->setErrorCode("INVALID_METHOD")
        ->send();
    \App\Library\Router\Router::getInstance()->setCommandResponse($res);
});


$router->group('api/v1', function ($api) use ($router) {
        $api->get('test', 'Test@index');
        $api->get('user', 'AuthController@userLogin');
}, ['before' => "TestMiddleware"]);

$router->group('api/v1/admin', function ($api) {
/*    $api->get('test', 'Todo@test');*/
});

$router->run();

$res = $router->getCommandResponse();
$res->sendParent();