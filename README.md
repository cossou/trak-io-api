# Trak.io Api Client

[![Build Status](https://travis-ci.org/cossou/trak-io-api.png?branch=master)](https://travis-ci.org/cossou/trak-io-api)

## Installation 

Install via [Composer](http://getcomposer.org/):

```
{
    "require": {
        "cossou/trak-io-api-client": "1.0.*@dev"
    }
}

```

## Methods available

* identify
* alias
* track
* annotate

Documentation: http://docs.trak.io/

## Examples

Quick [Identify](http://docs.trak.io/identify.html) example:

```

require_once 'vendor/autoload.php';

use Cossou\Trakio;

$trakio = Trakio::factory(array(
    'token' => 'YOUR-API-TOKEN'
));

try {
    $response = $trakio->identify(array('distinct_id' => 123, 'properties' => array('name' => 'Hélder Duarte')));
    var_dump($response);
} catch(Exception $e) {
    echo $e->getMessage();
}

```

## Laravel

Add to your app/config/app.php file and scroll down to your providers and add

```
'providers' => array(
    ...
    'Cossou\TrakioServiceProvider',
)
```

And the alias:

```
'aliases' => array(
	...
   	'Trakio'		  => 'Cossou\Facades\Trakio',

```

And finally you run `php artisan config:publish cossou/trak-io-api-client` and fill in your API key.

And that's it!

### Quick Laravel Example

```
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
