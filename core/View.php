<?php

namespace Core;

class View
{
    public $content;

    public function load(string $viewName,array $data=[])
    {
        ob_start();
        require BASEDIR.'/app/View'.$viewName.'.php';
        $this->content = ob_get_contents();
        ob_clean();
    }

    public function __destruct()
    {
        echo $this->content;
    }

}