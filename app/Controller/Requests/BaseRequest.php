<?php

use App\Library\Validation\RequestValidation;
use Symfony\Component\HttpFoundation\Request;

class BaseRequest{
    use RequestValidation;

    protected $apiVersion;
    protected $apiGroup;
    protected $detectedUri;
    protected $initialRequest = null;
    public function __construct(Request $request)
    {
        $this->initialRequest = $request;

        $query = $request->query->all();
        $request_data = !empty($request->request) ? $request->request->all() : null;
        $attributes = !empty($request->attributes) ? $request->attributes->all() : [];
        $cookies = !empty($request->cookies) ? $request->cookies->all() : [];
        $files = !empty($request->files) ? $request->files->all() : [];
        $server = !empty($request->server) ? $request->server->all() : [];
        $content = !empty($request->content) ? $request->content->all() : null;

        parent::__construct(
            $query, $request_data,
            $attributes,
            $cookies,
            $files,
            $server,
            $content
        );

        $this->detectRequest();
    }
}