<?php


if (!function_exists('assets')) {
    function assets($assetsName): string
    {
        return SITE_URL . 'public/' . $assetsName;
    }
}

if (!function_exists('redirect')) {
    function redirect($url): void
    {
        header('Location:' . SITE_URL . '/' . $url);
    }
}

if (!function_exists('redirectToHome')) {
    function redirectToHome(): void
    {
        header('Location:' . SITE_URL . '/');
    }
}
