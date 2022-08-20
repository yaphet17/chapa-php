<?php

namespace Chapa\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

/**
 * The PostData class is an object representation of JSON data
 * returned from Chapa API.
 */
class ResponseData
{

    private $message;
    private $success;
    private $data;

    /**
     * @param json  $response JSON data to be mapped to ResponseData object.
     */
    public function __construct($response)
    {
        $response = json_decode($response);
        $this->message = $response->message;
        $this->success = $response->status;
        $this->data = $response->data;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getData()
    {
        return $this->data;
    }
}
