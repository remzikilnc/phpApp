<?php
//Path Settings
define('BASEDIR', dirname(__DIR__, 1));

if ((isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) || (isset($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] == 443)) {
    $_SERVER['HTTPS'] = 'on';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $_SERVER['HTTPS'] = 'on';
} else {
    $_SERVER['HTTPS'] = null;
    unset($_SERVER['HTTPS']);
}
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on" ? 'https://' : 'http://';
$_url_ = $http . $_SERVER['HTTP_HOST'] . '/';

//https
define('SITE_URL', $_url_);
