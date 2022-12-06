<?php

namespace App\Library\Core;

use App\Library\Database\Database;
use App\Library\Router\Router;

class Starter
{
    public Router $router;
    public View $view;
    public Database $db;

    public function __construct()
    {
        $this->router = new Router([
            'base_folder' => BASEDIR,
            'main_method' => 'main',
            'paths' => [
                'controllers' => 'app/Controller',
            ],
            'namespaces' => [
                'controllers' => 'App\Controller',
            ],
        ]);
        $this->db = new Database();
        $this->view = new View();
    }

}