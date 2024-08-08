<?php

namespace IlknurDogan\ExchangeRate;

require __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;
 class ExchangeRate
{

    public function validateDateFormat($date) {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);
        return $dateTime && $dateTime->format('Y-m-d') === $date;
    }

    public function validateCurrency($from, $to) {
        $validCurrencies= ["TRY", "USD", "AUD", "DKK", "EUR", "GBP", "CHF", "SEK", "CAD", "KWD", "NOK", "SAR", "JPY", "BGN", "RON", "RUB", "IRR", "CNY", "PKR", "QAR", "KRW", "AZN", "AED", "XDR"];

        if ((!in_array($from, $validCurrencies) || !in_array($to, $validCurrencies)) ) {
            throw new \InvalidArgumentException('Invalid currency code. Please use one of the following: ' . implode(', ', $validCurrencies));
        }

        return true;
    }


    public  function  getRate($date){

        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);
        if (!$this->validateDateFormat($date)) {
            throw new \InvalidArgumentException('Invalid date format. Expected format: YYYY-MM-DD');
        }

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
    
        public function convert($date, $from, $to) {
            $rates = $this->getRate($date);
          
            $currencies = $rates["Currency"];
    
            $fromRate = null;
            $toRate = null;
            
            if($this->validateCurrency($from, $to)){
                foreach ($currencies as $currency) {
                    if ($from === 'TRY') {
                        $fromRate = 1.0;
                    } else if ($currency['@attributes']['Kod'] === $from) {
                        $fromRate = $currency['ForexSelling'];
                    }
        
                    if ($to === 'TRY') {
                        $toRate =  1.0;
                    } else if ($currency['@attributes']['Kod'] === $to) {
                        $toRate = $currency['ForexBuying'];
                    }
        
                }
            }
           
          
            if ($from !== 'TRY' && $to !== 'TRY' && isset($currency['CrossRateUSD'])) {
                $fromRateUSD = null;
                $toRateUSD = null;
                foreach ($currencies as $curr) {
                    if ($curr['@attributes']['Kod'] === $from) {
                        $fromRateUSD = $curr['CrossRateUSD'];
                    }
                    if ($curr['@attributes']['Kod'] === $to) {
                        $toRateUSD = $curr['CrossRateUSD'];
                    }
                }
                if ($fromRateUSD && $toRateUSD) {
                    return number_format($toRateUSD / $fromRateUSD, 2,',','');
                }
            }
    
            if ($fromRate === null || $toRate === null) {
                throw new \Exception("Conversion rate not found.");
            }
    
            return number_format($fromRate / $toRate,2,",","");
        }




}

