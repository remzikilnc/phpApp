<?php

namespace App\Controller;

use Core\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class User extends BaseController
{
    public function index(Request $request, Response $response) {
        $response->setContent('Hello World');
        return $response;
    }
    public function showProfile(Request $request, Response $response)
    {
    }
}