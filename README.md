# ExchangeRate PHP Kütüphanesi

Bu kütüphane, Türkiye Cumhuriyet Merkez Bankası'ndan (TCMB) döviz kurlarını çekmek ve belirli tarihlerdeki döviz dönüşümlerini gerçekleştirmek için geliştirilmiştir.

## Kurulum

Bu kütüphaneyi kullanmak için Composer kullanarak yükleyebilirsiniz.

```bash
composer require ilknur-dogan/exchange-rate
```

## Kullanım
### 1. Kur Bilgisi Alma
Belirli bir tarihe ait döviz kur bilgilerini almak için getRate metodunu kullanabilirsiniz.

```bash
getRate($date)
```
- Verilen tarihe ait döviz kurlarını bir dizi olarak döndürür.
- $date: Döviz kurlarının alınacağı tarih (YYYY-MM-DD formatında).

```bash
require 'vendor/autoload.php';

use IlknurDogan\ExchangeRate\ExchangeRate;

$exchangeRate = new ExchangeRate();
$rates = $exchangeRate->getRate('2024-08-01'); // Örnek tarih
print_r($rates);
```

### 2. Döviz Dönüşümü
Belirli bir tarihteki iki döviz birimi arasında dönüşüm yapmak için convert metodunu kullanabilirsiniz.

```bash
convert($date, $from, $to)
```
- Verilen tarihte iki döviz birimi arasındaki dönüşüm oranını döndürür(string formatında).
- $date: Döviz kurlarının alınacağı tarih (YYYY-MM-DD formatında).
- $from: Dönüştürülmek istenen döviz birimi (Örn: USD).
- $to: Dönüştürülmek istenen döviz birimi (Örn: EUR).
  
```bash
require 'vendor/autoload.php';

use IlknurDogan\ExchangeRate\ExchangeRate;

$exchangeRate = new ExchangeRate();
$convertedAmount = $exchangeRate->convert('2024-08-01', 'USD', 'EUR'); // Örnek tarih ve döviz birimleri
echo $convertedAmount;
```
