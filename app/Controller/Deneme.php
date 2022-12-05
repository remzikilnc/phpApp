<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Deneme extends \Core\BaseController
{
    public function Test()
    {
         return 'Hello World!';
    }
}