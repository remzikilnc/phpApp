<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Library\Jwt\JWT;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends BaseController
{
    public function userLogin(Request $request){
        //Todo userLogin
        $jwt = $request->get('jwt');
        $email = $request->get('email');
        $id = $request->get('id');

        $condition = [];

        if (!empty($email)) {
            $condition['username'] = (string)$email;
        } else if (!empty($id)) {
            $condition['id'] = (int)$id;
        } else {
            throw new BadRequestException("error_parameter");
        }

/*        try {
            JWT::decode()
        }*/

    }

}