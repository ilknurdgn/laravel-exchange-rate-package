# ExchangeRate PHP Library
<div style="text-align: center">
<a href="https://packagist.org/packages/ilknur-dogan/exchange-rate" rel="nofollow">
    <img src="https://img.shields.io/packagist/v/ilknur-dogan/exchange-rate" alt="Latest Stable Version">
</a>

<a href="https://packagist.org/packages/ilknur-dogan/exchange-rate" rel="nofollow">
    <img src="https://img.shields.io/packagist/dt/ilknur-dogan/exchange-rate" alt="Total Downloads">
</a>

<a href="https://packagist.org/packages/ilknur-dogan/exchange-rate" rel="nofollow">
    <img src="https://poser.pugx.org/ilknur-dogan/exchange-rate/dependents.svg" alt="Dependents">
</a>


<a href="https://packagist.org/packages/ilknur-dogan/exchange-rate" rel="nofollow">
    <img src="https://img.shields.io/packagist/l/ilknur-dogan/exchange-rate" alt="License">
</a>

<a href="https://packagist.org/packages/ilknur-dogan/exchange-rate">
    <img src="https://github.styleci.io/repos/672379930/shield?branch=master" alt="StyleCI">
</a>

</div>




This library is designed to fetch exchange rates from the Central Bank of the Republic of Turkey (TCMB) and perform currency conversions for specific dates.

## Installation

You can install this library using Composer.

```bash
composer require ilknur-dogan/exchange-rate
```

## Usage
### 1. Fetching Exchange Rates
You can use the getRate method to retrieve exchange rates for a specific date.

```bash
getRate($date)
```
- Returns exchange rates for the specified date as an array.
- $date: The date for which exchange rates are to be retrieved (in YYYY-MM-DD format).

```bash
require 'vendor/autoload.php';

use IlknurDogan\ExchangeRate\ExchangeRate;

$exchangeRate = new ExchangeRate();
$rates = $exchangeRate->getRate('2024-08-01'); // Example date
print_r($rates);
```

### 2. Currency Conversion
You can use the convert method to perform a currency conversion between two currencies for a specific date.

```bash
convert($date, $from, $to)
```

- Returns the conversion rate between the two currencies for the specified date (as a string).
- $date: The date for which the exchange rate is to be used (in YYYY-MM-DD format).
- $from: The currency to be converted from (e.g., USD).
- $to: The currency to be converted to (e.g., EUR).
  
```bash
require 'vendor/autoload.php';

use IlknurDogan\ExchangeRate\ExchangeRate;

$exchangeRate = new ExchangeRate();
$convertedAmount = $exchangeRate->convert('2024-08-01', 'USD', 'EUR'); // Example date and currencies
echo $convertedAmount;
```
## License
This package is open source software licensed under the MIT License.
