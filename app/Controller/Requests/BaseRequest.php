<?php

namespace App\Controller\Requests;


use App\Library\Validation\RequestValidation;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\Request;

interface BaseRequestInterface
{
    public function adminRequest();

    public function userRequest();
}

class BaseRequest extends Request implements BaseRequestInterface
{
    use RequestValidation

    protected $initialRequest = null;
    protected string $apiVersion;
    protected string $apiGroup;

    public function __construct(Request $request)
    {
        $this->initialRequest = $request;

        $query = $this->initialRequest->query->all();
        $request_data = !empty($this->initialRequest->request) ? $this->initialRequest->request->all() : null;
        $cookies = !empty($this->initialRequest->cookies) ? $this->initialRequest->cookies->all() : [];
        $attributes = !empty($this->initialRequest->attributes) ? $this->initialRequest->attributes->all() : [];
        $files = !empty($this->initialRequest->files) ? $this->initialRequest->files->all() : [];
        $server = !empty($this->initialRequest->server) ? $this->initialRequest->server->all() : [];
        $content = !empty($this->initialRequest->content) ? $this->initialRequest->content : null;

        parent::__construct(
            $query,
            $request_data,
            $attributes,
            $cookies,
            $files,
            $server,
            $content
        );
        $this->detectRequest();
    }

    public function run()
    {
        static::prepareRequestDataForValidation($this->initialRequest);
    }

    public function detectRequest(){
        try {
            $uri = explode("/",ltrim($this->getRequestUri(), '/'));
            $this->apiVersion = $uri[1];
            $this->apiGroup = $uri[2];
            switch ($this->apiGroup){
                case 'admin':
                    $this->adminRequest();
                    break;
                default :
                    $this->userRequest();
                    break;
            }
        }catch (Exception $exception){
            $this->userRequest();
        }
        $this->run();
    }
}