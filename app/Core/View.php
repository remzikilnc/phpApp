<?php

namespace App\Core;

class View
{
    public $content;

    public function load(string $viewName, array $data = [])
    {
        ob_start();
        extract($data);
        require BASEDIR . '/app/View/' . $viewName . '.php';
        $this->content = ob_get_contents();
        ob_clean();
        return $this;
    }

    public function __destruct()
    {
        echo $this->content;
    }

}