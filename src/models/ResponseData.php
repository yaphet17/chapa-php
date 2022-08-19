<?php

namespace Chapa\Models;

require_once __DIR__."/../../vendor/autoload.php";

class ResponseData{

    private $message;
    private $success;
    private $data;

    public function __construct($response)
    {
        $response = json_decode($response);
        $this->message = $response->message;
        $this->success = $response->status;
        $this->data = $response->data;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getSuccess(){
        return $this->success;
    }

    public function getData(){
        return $this->data;
    }
}