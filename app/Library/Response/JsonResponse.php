<?php

namespace App\Library\Response;

use App\Library\Jwt\Token;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse extends Response
{

    private $json;

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
        $this->json = new Json();
    }

    public function getStatus()
    {
        return $this->json->status;
    }

    public function getMessage()
    {
        return $this->json->message;
    }

    public function getErrorCode()
    {
        return $this->json->errorCode;
    }

    public function getData()
    {
        return $this->json->data;
    }

    public function getPaging()
    {
        return $this->json->paging;
    }

    public function setStatus($status): static
    {
        $this->json->status = $status;

        return $this;
    }

    public function setMessage($message): static
    {
        $this->json->message = $message;

        return $this;
    }


    public function setErrorCode($errorCode): static
    {
        $this->json->errorCode = $errorCode;

        return $this;
    }

    public function setData($data): static
    {

        if (gettype($data) == 'array') {
            if (false == empty($data) && !isset($data[0])) {
                $data = array($data);
            }
        } else {
            $data = array($data);
        }
        $this->json->data = $data;
        return $this;
    }

    public function setPaging($total, $start = 0, $limit = 0): static
    {
        $page = $limit > 0 ? ceil($total / $limit) : 1;

        $this->json->paging = [
            'total' => $total,
            'start' => $start,
            'limit' => $limit,
            'page' => $page
        ];

        return $this;
    }

    public function send():static
    {

        try {
            $jwtData = Token::decode();

            if ($jwtData !== false) {
                $this->json->session = $jwtData->data;
            }
        } catch (\Exception $ex) {
        }

        if (empty($this->json->paging)) {
            unset($this->json->paging);
        }

        //  $this->setContent($this->json->__toJson());
        //        $r = parent::send();

        return $this;
    }

    public function sendParent()
    {
        if (empty($this->json->paging)) {
            unset($this->json->paging);
        }
        $this->headers->set("Content-Type", "application/json");
        $this->setContent($this->json->__toJson());
        parent::send();
        $this->json->reset();
    }

    public function getAllData(): array
    {

        return $this->json->__toArray();
    }
}

class Json
{

    public $status = false;
    public $message = "";
    public $errorCode = "";
    public $data = array();
    public $paging = array();

    public function __construct()
    {
    }

    public function __toJson(): bool|string
    {
        return json_encode(get_object_vars($this));
    }

    public function __toArray(): array
    {
        return get_object_vars($this);
    }

    public function reset(): void
    {
        $this->status = false;
        $this->message = array();
        $this->errorCode = "";
        $this->data = array();
        $this->paging = array();
    }
}
