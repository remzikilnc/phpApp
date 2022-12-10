<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Library\Response\JsonResponse;
use App\Model\TaskModel;
use Pixie\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Todo extends BaseController
{

    public function index()
    {

    }

    public function create(Request $request, Response $response)
    {
        $message = $request->get('test');
        $response = new JsonResponse();
        $response->setStatusCode(200)->setStatus(true)->setMessage('yar')->setData([
            'data' => $message
        ])->sendParent();
    }

    /**
     * @throws Exception
     */
    public function test()
    {
        $testQuery = TaskModel::where('id','=','1');
        var_dump($testQuery->get());

    }
}