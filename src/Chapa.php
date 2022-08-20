<?php

namespace Chapa;

require_once __DIR__ . "/../vendor/autoload.php";

use Chapa\Models\PostData;
use Exception;
use Chapa\Util;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Chapa\Models\ResponseData;

/**
 * The Chapa class is responsible for making GET and POST request to Chapa API
 * to initialize payment and verify transactions.
 */
class Chapa
{

    const baseUrl = 'https://api.chapa.co/';
    const apiVersion = 'v1';

    private $client;
    private $headers;
    private $secreteKey;

    /**
     *
     * @param string  $secreteKey A secrete key provided from Chapa.
     */
    function __construct($secreteKey)
    {

        $this->secreteKey = $secreteKey;
        $this->client = new Client(['base_uri' => self::baseUrl]);
        $this->headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->secreteKey
        ];
    }

    /**
     * @param  PostData                              $postData An object that represents post fields.
     * @return ResponseData                                    An object that represents response data from Chapa API.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function initialize($postData)
    {
        Util::validate($postData);

        $request = new Request('POST', self::apiVersion . '/transaction/initialize');
        $response = $this->client->send($request, [
            'headers' => $this->headers,
            'form_params' => $postData->getAsKeyValue()
        ]);
        $responseData = new ResponseData($response->getBody());
        return $responseData;
    }

    /**
     * @param string                                $transactionRef Transaction reference that uniquely identifies
     *                                                              the transaction to be validated.
     * @return bool                                                 True if transaction is verified otherwise false.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function isPaymentVerified($transactionRef)
    {
        $request = new Request('GET', self::apiVersion . '/transaction/verify/' . $transactionRef);
        try {
            $response = $this->client->send($request, [
                'headers' => $this->headers,
            ]);
        } catch (Exception $e) {
            return false;
        }

        return $response->getStatusCode() == 200;
    }
}
