<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
// ini_set("log_errors", 1);

const ROOT_PATH = __DIR__;
require_once 'bootstrap.php';

/*require BASEDIR . '/app/Helpers/app.php';



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

require BASEDIR . '/routes/route.php';*/
