<?php

namespace Chapa\Model;

/**
 * The PostData class is an object representation of JSON data
 * returned from Chapa API.
 */
class ResponseData
{

    private $json;
    private $statusCode;
    private $message;
    private $status;
    private $data;

    /**
     * @param json  $response JSON data to be mapped to ResponseData object.
     */
    public function __construct($response, $statusCode)
    {
        $responseData = json_decode($response, true);

        $this->json = $response;
        $this->statusCode = $statusCode;
        $this->message = array('message' => $responseData['message']);
        $this->status = array('status' => $responseData['status']);
        $this->data = array('data' => $responseData['data']);
    }

    public function getRawJson(){
        return $this->json;
    }

    public function getStatusCode(){
        return $this->statusCode;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getData()
    {
        return $this->data;
    }
}
