<?php

namespace App\Controller;

use App\Core\BaseController;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends BaseController
{
    public function userLogin(Request $request){
        $jwt = $request->get('jwt');
        $email = $request->get('email');
        $id = $request->get('id');
        $phone = $request->get('phone');
    }

}