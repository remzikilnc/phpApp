<?php

namespace App\Library\Jwt;

use App\Library\Jwt\JWT;

class Token
{

    private static $data;
    private static $token;
    private static $algorithms = ["HS256"];


    static function setToken($token): void
    {
        self::$token = $token;
    }

    static function getToken()
    {
        return self::$token;
    }


    static function getAlgorithms(): array
    {
        return self::$algorithms;
    }

    static function getJwtKey(): string
    {
        return substr(md5(SITE_URL . 'jwt_fd_secret_key' . date("Y")), 0, 12);
    }

    static function getExpirationTime(): float|int
    {
        /*TODO bu kisim ayarlara baglanmalidir.*/
        return (time() + (3 * 60 * 60));
    }

    static function encode($data): array
    {
        print_r($data);
        exit();
        $expTime = self::getExpirationTime();
        $iat = time();
        $token = array(
            "iss" => $_SERVER['HTTP_HOST'],
            "aud" => $_SERVER['REMOTE_ADDR'],
            "iat" => $iat,
            "exp" => $expTime,
            "data" => $data
        );
        print_r($token);

        $jwt = JWT::encode($token, self::getJwtKey());
        return [
            'bearer' => $jwt,
            'exp_at' => $expTime,
            'issued_at' => $iat
        ];
    }

    static function decode(): object
    {


        self::setToken(trim(str_replace('Bearer ', '', self::getToken())));



        return JWT::decode(self::getToken(), self::getJwtKey(), self::$algorithms);
    }

    public static function data($key): bool
    {

        if (isset(self::$data->{$key})) {
            return self::$data->{$key};
        }

        return false;
    }

}
