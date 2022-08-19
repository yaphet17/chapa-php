<?php

namespace Chapa;

require_once __DIR__."/../vendor/autoload.php";

use GuzzleHttp\Client;
use Chapa\Models\ResponseData;
use GuzzleHttp\Psr7\Request;

class Chapa
{

    const baseUrl = 'https://api.chapa.co/';
    const apiVersion = 'v1';

    private $client;
    private $headers;
    private $secreteKey;


    public function __construct($secreteKey)
    {

        $this->secreteKey = $secreteKey;
        $this->client = new Client(['base_uri' => self::baseUrl]);
        $this->headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer ' . $this->secreteKey
        ];
    }


    public function initialize($data)
    {
        // TODO: validate json data
        $request = new Request('POST', self::apiVersion . '/transaction/initialize');
        $response = $this->client->send($request, [
            'headers' => $this->headers,
            'form_params' => $data->getAsKeyValue()
        ]);
        $responseData = new ResponseData($response->getBody());
        return $responseData;
    }

    public function verify($transactionRef)
    {
    }
}


