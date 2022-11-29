<?php

namespace Core;

class Starter
{
    public $router;
    protected $db;

    public function __construct()
    {
        $this->router = new \App\Library\Router\Router();
        $this->db = new Database();
    }
}