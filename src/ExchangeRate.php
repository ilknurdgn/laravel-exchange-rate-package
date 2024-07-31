<?php

namespace IlknurDogan\ExchangeRate;

require __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;
 class ExchangeRate
{

    public  function  getRate($date){
        $currentDate = date("dmY");
        $dateTime = new \DateTime($date);
        $ymDateFormat = $dateTime->format("Ym");
        $dmyDateFormat= $dateTime->format("dmY");
    
        $client = new Client();
    
        if($currentDate === $dmyDateFormat){
            $url =  "https://www.tcmb.gov.tr/kurlar/today.xml";
        }else{
            $url = "https://www.tcmb.gov.tr/kurlar/{$ymDateFormat}/{$dmyDateFormat}.xml";
        }
    
           $response = $client->request('GET', $url);
    
    
            if ($response->getStatusCode() == 200) {
                $xml = $response->getBody()->getContents();
                $xmlObject = simplexml_load_string($xml);
                $json = json_encode($xmlObject);
                return json_decode($json, true);
            }
    
            throw new \Exception('Unable to fetch exchange rates');
        }
    
        public function convert($date, $from) {
            $rates = $this->getRate($date);
          
            $currencies = $rates["Currency"];
    
            $fromRate = null;
    
            foreach ($currencies as $currency) {
                if ($currency['@attributes']['Kod'] === $from) {
                    $fromRate = $currency['ForexBuying'];
                }
            }
    
            if ($fromRate === null) {
                throw new \Exception("Conversion rate 
                not found.");
            }
    
    
            return $fromRate;
        }
}