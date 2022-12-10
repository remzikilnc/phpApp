<?php
require __DIR__ . '/config/config.php';
require BASEDIR . '/routes/autoload.php';
require BASEDIR . '/app/Helpers/app.php';

$loader = new Psr4AutoloaderClass();
$loader->addNamespace('App', '/app');
$loader->addNamespace('Symfony\Component\HttpFoundation', '/app/Library/HttpFoundation');
$loader->addNamespace('Pixie', '/app/Library/QueryBuilder/Pixie');
$loader->addNamespace('Viocon', '/app/Library/QueryBuilder/Viocon');
$loader->register();

if (version_compare(phpversion(), '8', '<')) {
    print_r('Php versiyonunuz: ' . phpversion());
    echo '<br>';
    print_r(phpversion() . ' web.php' . 'uygulamayı kullanabilmek için uyumlu değil.');
    exit();
}

session_start();
$router= new App\Library\Router\Router([
    'base_folder' => BASEDIR,
    'main_method' => 'main',
    'paths' => [
        'controllers' => 'app/Controller',
    ],
    'namespaces' => [
        'controllers' => 'App\Controller',
    ],
]);

require BASEDIR . '/routes/route.php';
