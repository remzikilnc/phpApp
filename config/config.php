<?php
define('BASEDIR', dirname(__DIR__, 1));
define('URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https://" : "http://" . $_SERVER['SERVER_NAME']);