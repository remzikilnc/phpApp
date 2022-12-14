<?php

namespace System\Helper;

class Config
{
    public static $settings;
    public static function load($fileName): void
    {
        if (file_exists($fileName)) {
            include $fileName;
            self::$settings = $config;
            if (self::$settings["DEBUG"] == "1") {
                ini_set("display_errors", 1);
                ini_set("display_startup_errors", 1);
                error_reporting(-1);
            }else{
                error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
                ini_set("display_errors", 0);
                ini_set("display_startup_errors", 0);
            }

            ini_set("log_errors", 1);
        }else{
            echo "Please reconstruct the config.";
        }
    }

    public static function get($key)
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    public static function getAll()
    {
        return self::$settings;
    }

    // Example: Licence Global.licence..
    public static function getLicence($key)
    {

        $licencePath = ROOT_PATH . '/Data/Licence/';
        $filename = $licencePath . $key . '.licence';

        if (file_exists($filename)) {
            return (int)file_get_contents($filename) === 1;
        } else {
            return false;
        }
    }
}