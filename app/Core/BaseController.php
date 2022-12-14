<?php

namespace App\Core;

use App\Library\Response\JsonResponse;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BaseController
{
    protected JsonResponse $response;

    public function __construct()
    {
        //TODO Cache
        $this->response = new JsonResponse();
    }

}