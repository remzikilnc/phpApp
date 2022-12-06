<?php
$router->group('api', function ($api) use ($router) {

    $router->group('todos', function ($api) use ($api) {
        $api->get('test', 'Todo@index');
    });

});