<?php

namespace NetkodBilisim\ExchangeRate;

use Illuminate\Support\ServiceProvider;

class ExchangeRateServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ExchangeRate::class, function ($app) {
            $apiKey = config('exchange-rate.exchange_rate.api_key');
            return new ExchangeRate($apiKey);
        });
    }

    public function boot()
    {

}
}
