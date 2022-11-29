<?php
if (version_compare(phpversion(), '8', '<')) {
    print_r('Php versiyonunuz: ' . phpversion());
    echo '<br>';
    print_r(phpversion() . ' web.php' . 'uygulamayı kullanabilmek için uyumlu değil.');
    exit();
}
session_start();

$cms->router->match('GET|POST', '/', function () {
    echo 'w';
});
