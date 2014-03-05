# Trak.io Api Client

[![Build Status](https://travis-ci.org/cossou/trak-io-api.png?branch=master)](https://travis-ci.org/cossou/trak-io-api)
[![Latest Stable Version](https://poser.pugx.org/cossou/trak-io-api-client/v/stable.png)](https://packagist.org/packages/cossou/trak-io-api-client) 
[![Total Downloads](https://poser.pugx.org/cossou/trak-io-api-client/downloads.png)](https://packagist.org/packages/cossou/trak-io-api-client) 
[![Latest Unstable Version](https://poser.pugx.org/cossou/trak-io-api-client/v/unstable.png)](https://packagist.org/packages/cossou/trak-io-api-client) 
[![License](https://poser.pugx.org/cossou/trak-io-api-client/license.png)](https://packagist.org/packages/cossou/trak-io-api-client)

## Installation 

Install via [Composer](http://getcomposer.org/):

```
{
    "require": {
        "cossou/trak-io-api-client": "1.0.*"
    }
}

```

## Methods available

* identify
* alias
* track
* annotate
* distinct_id
* channel

Documentation: http://docs.trak.io/

## Examples

Quick [Identify](http://docs.trak.io/identify.html) example:

```php

require_once 'vendor/autoload.php';

use Cossou\Trakio;

$trakio = Trakio::init('YOUR-API-TOKEN');

// or
// $trakio = Trakio::init('YOUR-API-TOKEN', array('distinct_id' => 123));

try {
    $response = $trakio->identify(array('distinct_id' => 123, 'properties' => array('name' => 'Hélder Duarte')));
    var_dump($response);
} catch(Exception $e) {
    echo $e->getMessage();
}

```

## Laravel

Add to your app/config/app.php file and scroll down to your providers and add

```php
'providers' => array(
    ...
    'Cossou\TrakioServiceProvider',
)
```

And the alias:

```php
'aliases' => array(
	...
   	'Trakio'		  => 'Cossou\Facades\Trakio',

```

And finally you run `php artisan config:publish cossou/trak-io-api-client` and fill in your API key.

And that's it!

### Quick Laravel Example

```php
Route::get('/', function()
{
	$trak = new Trakio;

	try {
		$response = $trak::identify(array('distinct_id' => 123, 'properties' => array('name' => 'Hélder Duarte')));
		dd($response);
	} catch(Exception $e) {
		dd($e->getMessage());
	}	
}

```

## License

MIT License
