<?php

namespace Chapa;

require_once __DIR__."/../vendor/autoload.php";

use Dotenv\Dotenv;
use GuzzleHttp\Client;

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
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->secreteKey
        ];
    }


    public function initialize($data)
    {
        // TODO: validate json data
        $options = [
            'headers' => $this->headers,
            'body' => json_encode($data)
        ];

        $response = $this->client->post(self::apiVersion . '/transaction/initialize', $options);
        return $response->getBody();
    }

    public function verify($transactionRef)
    {
    }
}

$dotenv = Dotenv::createImmutable(__DIR__ );
$dotenv->load();
$secreteKey = $_ENV['SECRETE_KEY'];
$chapa = new Chapa($secreteKey);
echo $chapa->initialize(
    array(
        'amount' => '100', 
        'currency' => 'ETB',
        'email' => 'yafetberhanu3@gmail.com',
        'first_name' => 'Yafet',
        'last_name' => 'Berhanu',
        'tx_ref' => 'tx-this-is-random',
        'customization[title]' => 'I love e-commerce',
        'customization[description]' => 'It is time to pay'
    )
);
