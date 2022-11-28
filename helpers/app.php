<?php

     function route(int $index){
        global $config;
         return $config['route'][$index] ?? false;
    }

    function view(string $viewName, $data = null){
        if (file_exists(BASEDIR.'/View/'.$viewName.'.php')) require BASEDIR.'/View/'.$viewName.'.php';
        else return false;

    }