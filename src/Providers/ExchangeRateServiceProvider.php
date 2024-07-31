<?php

namespace IlknurDogan\ExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use IlknurDogan\ExchangeRate\ExchangeRate;

class ExchangeRateServiceProvider extends ServiceProvider
{
    public function register(){

         // Paketin yapılandırma dosyasındaki varsayılan değerleri, uygulamanızın mevcut yapılandırmasıyla birleştirir.
        // Dosyayı doğrudan kopyalamaz, sadece değerleri birleştirir.
    //    $this->mergeConfigFrom(
    //     __DIR__.'/../../config/exchange-rate.php', 'exchange_rate'
    //    );

        $this->app->bind(ExchangeRate::class,function($app){
            // $apiKey = config("exchange_rate.api_key");
            return new ExchangeRate();
           });
    }
    public function boot(){

        //Kullanıcıların paketin yapılandırma dosyalarını uygulamalarının config dizinine kopyalamasını sağlar.
        // Kullanıcılar bu dosyada değişiklik yaparak kendi ihtiyaçlarına göre özelleştirebilirler.
        // $this->publishes([
        //     __DIR__."/../../config/exchange-rate.php" => config_path("exchange-rate.php")
        // ], "config");
    }
}
