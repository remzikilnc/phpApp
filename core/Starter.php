<?php

namespace Core;

class Starter
{
    public \App\Library\Router\Router $router;
    public Request $request;
    public View $view;
    protected Database $db;

    public function __construct()
    {
        $this->router = new \App\Library\Router\Router();
        $this->db = new Database();
        $this->request = new Request();
        $this->view = new View();
    }
}