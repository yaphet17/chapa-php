<?php

namespace Chapa;

require_once __DIR__ . "/../vendor/autoload.php";

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Chapa\Models\ResponseData;

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


    public function initialize($postData)
    {
        // TODO: validate json data
        $request = new Request('POST', self::apiVersion . '/transaction/initialize');
        $response = $this->client->send($request, [
            'headers' => $this->headers,
            'form_params' => $postData->getAsKeyValue()
        ]);
        $responseData = new ResponseData($response->getBody());
        return $responseData;
    }

    public function isPaymentVerified($transactionRef)
    {
        $request = new Request('GET', self::apiVersion . '/transaction/verify/' . $transactionRef);

        try {
            $response = $this->client->send($request, [
                'headers' => $this->headers,
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }

        return $response->getStatusCode() == 200;
    }
}
