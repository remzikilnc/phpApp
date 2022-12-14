<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;

class TestMiddleware
{
    public function handle(Request $request)
    {
        echo 'TestMiddleware.';
        return true;
    }
}