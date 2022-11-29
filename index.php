<?php

require __DIR__.'/config/config.php';
require __DIR__ . '/routes/autoload.php';

$loader = new Psr4AutoloaderClass();
$loader->addNamespace('App', '/app');
$loader->addNamespace('Core', '/core');
$loader->register();


$cms = new \Core\Starter();
require __DIR__ . '/routes/route.php';
