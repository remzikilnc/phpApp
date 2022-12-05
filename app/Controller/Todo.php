<?php

namespace App\Controller;


use HttpRequest;
use HttpResponse;

class Todo extends \Core\BaseController
{

    public function index() {
        $todos = $this->db->query("SELECT * FROM todos_list",true);
        $this->view->load('todo/todo', compact('todos'));
    }
    public function create(HttpRequest $request) {
        echo 'qwe';
        print_r($request->getHeaders());

    }
}