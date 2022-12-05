<?php


$router->get('/deneme', 'Deneme@Test');
$router->get('/users', 'User@showProfile');
$router->group('todos',function () use ($router){
    $router->get('/', 'Todo@index');
    $router->post('/test', 'Todo@create');
});
