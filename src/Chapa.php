<?php

namespace Chapa;

require_once __DIR__."/../vendor/autoload.php";

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Chapa\Models\PostData;
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

$dotenv = Dotenv::createImmutable(__DIR__ );
$dotenv->load();
$secreteKey = $_ENV['SECRETE_KEY'];
$chapa = new Chapa($secreteKey);
$postData = new PostData();
$postData->amount(100)
        ->currency('ETB')
        ->email('yafetberhanu3@gmail.com')
        ->firstname('yafet')
        ->lastname('berhanu')
        ->transactionRef(bin2hex(random_bytes(10)))
        // ->callbackUrl('https://chapa.co')
        ->customizations(array(
            'customization[title]' => 'title',
            'customization[description]' => 'It is time to pay'
        )
    );

echo $chapa->initialize($postData);

/*
array(
        'amount' => '100', 
        'currency' => 'ETB',
        'email' => 'yafetberhanu3@gmail.com',
        'first_name' => 'Yafet',
        'last_name' => 'Berhanu',
        'tx_ref' => 'tx-this-is-random',
        'callback_url' => 'https://chapa.co',
        'customization[title]' => 'I love e-commerce',
        'customization[description]' => 'It is time to pay'
    ) */
