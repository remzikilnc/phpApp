<?php

namespace App\Library\Core;

class Session
{
    public static function getSession($name)
    {
        return $_SESSION[$name] ?? false;
    }

    public static function setSession($name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    public function removeSession()
    {
        session_start();
        session_destroy();
    }

}