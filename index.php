<?php
session_abort();
require __DIR__.'/config/config.php';
foreach (glob(BASEDIR . '/helpers/*.php') as $file) {
    require $file;
}

$config['route'][0] = 'home';
$config['lang'] = 'tr';

if (isset($_GET['route'])) {
    preg_match('@(?<lang>\b[a-z]{2}\b)?/?(?<route>.+)/?@', $_GET['route'], $result);
}
if (isset($result['lang'])) {
    file_exists(BASEDIR . '/lang/' . $result['lang'] . '.php') ? $config['lang'] = $result['lang'] : $config['lang'] = 'tr';
}
require BASEDIR . '/lang/' . $config['lang'] . '.php';

if (isset($result['route'])){
    $config['route'] = explode('/', $result['route']);
}

if (file_exists(BASEDIR . '/Controller/' . $config['route'][0] . '.php')) {
    require BASEDIR . '/Controller/' . $config['route'][0] . '.php';
} else echo 'Not Found';
