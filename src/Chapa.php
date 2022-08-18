<?php

namespace Chapa\Chapa;

use GuzzleHttp\Client;


class Chapa{

    const baseUrl = "https://api.chapa.co/v1";

    private $client;
    private $headers;
    private $secreteKey;


    public function __construct($secreteKey)
    {
        
     $this->secreteKey = $secreteKey;
     $this->client = new Client(['base_uri' => self::baseUrl]);
     $this-> headers = [
         'encoding' => 'application/json',
         'Authorization' => $this->secreteKey
     ];

    }


    public function initialize($data){
        // TODO: validate json data

        $respnose = $this->client->post('/transaction/initialize', $data);
    }

    public function verify($transactionRef){

    }
}