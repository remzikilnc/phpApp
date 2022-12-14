<?php
/**
 * Functions
 */


require_once 'System/Helper/Functions.php';


/**
 * AutoLoader
 * @var  $loader
 */
include_once ROOT_PATH . '/autoload.php';
$loader = new Psr4AutoloaderClass();
$loader->addNamespace('App', '/app');
$loader->addNamespace('System', '/System');
$loader->addNamespace('Symfony\Component\HttpFoundation', '/app/Library/HttpFoundation');
$loader->addNamespace('System\Helper', '/System/Helper');
$loader->addNamespace('Pixie', '/app/Library/QueryBuilder/Pixie');
$loader->addNamespace('Viocon', '/app/Library/QueryBuilder/Viocon');
$loader->register();

/**
 * Config
 */
System\Helper\Config::load(ROOT_PATH . '/Config/config.php');
define("SITE_URL", System\Helper\Config::get('SITE_PATH'));
define("ADMIN_URI", System\Helper\Config::get('ADMIN_URI'));

/**
 * Session
 */
/*\App\System\Helper\Session::s();*/


$key = strtok(ltrim($_SERVER["REQUEST_URI"], '/'), '?');
$key = urldecode($key);

/**
 * Database Connection
 * @var  $database
 */
$database = new \App\Library\Database\Database();
/**
 * ROUTER
 */
    global $routerVar;
    $params = [
        'base_folder' => ROOT_PATH,
        'main_method' => 'web',
        'paths' => [
            'controllers' => './System/Controller',
        ],
        'namespaces' => [
            'controllers' => 'System\Controller',
        ]
    ];
    $router = \App\Library\Router\Router::getInstance();
    $router->setParams($params);
    $router->get('test', 'TestController@index');
    $router->run();
