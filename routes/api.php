<?php
$router->group('api', function ($api) use ($router) {

    $router->group('todos', function () use ($api) {
        $api->get('test', 'Todo@test');
    });

});