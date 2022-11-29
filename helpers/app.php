<?php

/**
 * @param int $index
 * @return false|mixed
 */
function route(int $index)
{
    global $config;
    return $config['route'][$index] ?? false;
}

/**
 * @param string $viewName
 * @param $data
 * @return false|void
 */
function view(string $viewName, $data = null)
{
    if (file_exists(BASEDIR . '/vview/' . $viewName . '.php')) require BASEDIR . '/viview/' . $viewName . '.php';
    else return false;
}

/**
 * @param $assetName
 * @return string|void
 */
function assets($assetName)
{
    if (file_exists(BASEDIR . '/public/' . $assetName)) return URL . '/public/' . $assetName;
}

/**
 * @param $text
 * @return mixed
 */
function __($text): mixed
{
    global $lang;

    if (isset($lang[$text])) return $lang[$text];
    else return $text;
}