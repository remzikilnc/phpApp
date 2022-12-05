<?php


//$router->get('/users', 'User@showProfile');
$router->group('todos',function () use ($router){
    $router->get('/', 'Todo@index');
    $router->get('/test', 'Todo@test');
});
