<?php

namespace IlknurDogan\ExchangeRate;

require 'vendor/autoload.php';
use GuzzleHttp\Client;
 class ExchangeRate
{

private $apiKey;


public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

public function getRate($from){
    $client = new Client();
    $url = "https://v6.exchangerate-api.com/v6/{$this->apiKey}/latest/{$from}";


        $response =$client->request("GET", $url);

        if($response->getStatusCode()==200){

            return json_decode($response->getBody(),true);
        }

        throw new \Exception('Unable to fetch exchange rates');

    }

    public function convert($from, $to){
        $rates = $this->getRate($from);
        $rate = $rates["conversion_rates"][$to] ?? null;
        if($rate===null){
    throw new \Exception("Conversion rate from {$from} to {$to} not found.");
        }
    return  $rate;
    }
}
