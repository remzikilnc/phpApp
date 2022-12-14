<?php

namespace App;


class Helper
{
    public static function getGeneralSaltKey(): string
    {
        return \App\Library\Helpers\Config::get("DOMAIN") . "todoApi" . date("m");
    }
}