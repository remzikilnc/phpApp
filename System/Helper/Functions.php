<?php
if (!function_exists('writeLog')) {
    function writeLog($file = null, $txt = null, $append = true)
    {
        $dir = ROOT_PATH . "/Logs";
        $file = $dir . "/" . $file . ".txt";

        if (!is_dir($dir))
            @mkdir($dir, 0777, true);

        if ($append) {
            return file_put_contents($file, $txt, FILE_APPEND);
        } else {
            return file_put_contents($file, $txt);
        }
    }
}

if (!function_exists('no_direct_access')) {
    function no_direct_access(): void
    {
        if (!defined('BASEPATH'))
            exit('You don\'t have access.');
    }
}

if (!function_exists('getIP')) {
    function getIP()
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}

if (!function_exists('isMobile')) {
    function isMobile(): bool
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
}

if (!function_exists('getOS')) {
    function getOS(): string
    {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Unknown OS Platform";

        $os_array = array(
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }
}

if (!function_exists('getBrowser')) {
    function getBrowser(): string
    {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $browser = "Unknown Browser";

        $browser_array = array(
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser'
        );

        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;

        return $browser;
    }
}

if (!function_exists('is_ssl')) {
    function is_ssl(): bool
    {
        if ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTP_X_FORWARDED_PORT'] == 443 || $_SERVER['HTTP_X_FORWARDED_SCHEME'] == "https") {
            return true;
        }
        return false;
    }
}

if (function_exists('is_ssl') && !function_exists('getHttp')) {
    function getHttp(): string
    {
        return is_ssl() ? 'https://' : 'http://';
    }
}

if (function_exists('is_ssl') && function_exists('getHttp') && !function_exists('siteURL')) {
    function siteURL(): string
    {
        $http = is_ssl() ? 'https://' : 'http://';
        return $http . $_SERVER['HTTP_HOST'] . '/';
    }
}

if (!function_exists('sortBy')) {
    function sortBy($array, $field = 'sort', $direction = SORT_ASC): array
    {
        foreach ($array as $key => $value) {
            if (is_array($value) && !key_exists($field, $array)) {
                $array[$key][$field] = "";
            }
        }
        $array = !is_array($array) ? [] : $array;
        array_multisort(array_column($array, $field), $direction, $array);
        return $array;

    }
}