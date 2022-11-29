<?php

namespace Core;

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

}