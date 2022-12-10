<?php

namespace App\Core;

use App\Library\Response\JsonResponse;

class BaseController
{
    protected JsonResponse $response;

    public function __construct()
    {
        //TODO Cache
        $this->response = new JsonResponse();
    }

}