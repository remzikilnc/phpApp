<?php

namespace App\Controller;

use App\Library\Core\BaseController;
use App\Library\Response\JsonResponse;
use App\Model\Task;
use App\Model\TaskException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Todo extends BaseController
{

    public function index()
    {
        $todos = $this->db->query("SELECT * FROM todos_list", true);
        try {
            $response = new JsonResponse();
            $response->setStatus(201)->setData($todos)->sendParent();
        } catch (TaskException $exception) {
            echo 'Error:' . $exception->getMessage();
        }
    }

    public function create(Request $request, Response $response)
    {
        $message = $request->get('test');
        $response = new JsonResponse();
        $response->setStatusCode(200)->setStatus(true)->setMessage('yar')->setData([
            'data' => $message
        ])->sendParent();
    }

    public function test()
    {
        try {
            $task = new Task(1, 'deneme', 1, 5);
            $response = new JsonResponse();
            $response->setStatus(201)->setData($task->returnTaskAsArray())->sendParent();
        } catch (TaskException $exception) {
            echo 'Error:' . $exception->getMessage();
        }
    }
}