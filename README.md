# CoinMarketCap PHP Wrapper

PHP wrapper class for CoinMarketCap v2.

## Requirements

* PHP 5.3+
* [Composer](https://getcomposer.org/)

## Installation

`composer require d3vit/coinmarketcap-php`

## Usage

```
<?php

require __DIR__ . '/vendor/autoload.php';

use CoinMarketCap\Base;

$coinmarketcap = new Base();

// Get ticker
$coinmarketcap->getTicker();

// Get ticker by coin
$coin = 'bitcoin';
$coinmarketcap->getTickerByCoin($coin);

// Get global data
$coinmarketcap->getGlobalData();
```

See the [API documentation](https://coinmarketcap.com/api/) for more information about the endpoints and responses.
