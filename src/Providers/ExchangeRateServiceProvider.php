<?php

namespace IlknurDogan\ExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use IlknurDogan\ExchangeRate\ExchangeRate;

class ExchangeRateServiceProvider extends ServiceProvider
{
    public function register(){

        
    //    $this->mergeConfigFrom(
    //     __DIR__.'/../../config/exchange-rate.php', 'exchange_rate'
    //    );

        $this->app->bind(ExchangeRate::class,function($app){
            // $apiKey = config("exchange_rate.api_key");
            return new ExchangeRate();
           });
    }
    public function boot(){

        // $this->publishes([
        //     __DIR__."/../../config/exchange-rate.php" => config_path("exchange-rate.php")
        // ], "config");
    }
}
