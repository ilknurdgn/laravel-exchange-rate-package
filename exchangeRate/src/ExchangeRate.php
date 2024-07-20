<?php

namespace NetkodBilisim\ExchangeRate;
use Illuminate\Support\Facades\Http;
class ExchangeRate
{

private $apiKey ;


public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

public function getRate($from){
    $url = "https://v6.exchangerate-api.com/v6/{$this->apiKey}/latest/{$from}";


        $response = Http::get($url);

        if($response-> failed()){
            throw new \Exception('Failed to retrieve data from the URL.');
        }



    $data = $response->json();
    return $data['conversion_rates'] ['TRY'] ?? null;

}
}
