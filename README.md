# Trak.io Api Client

## Installation 

Install via [Composer](http://getcomposer.org/):

```
{
    "require": {
        "cossou/track-io-api-client": "1.0.*"
    }
}

````

## Methods available

* identify
* alias
* track
* annotate

Documentation: http://docs.trak.io/

Quick [Identify](http://docs.trak.io/identify.html) example:

```php
require_once 'vendor/autoload.php';

use Cossou\TrakioApiClient\Client\TrakioClient;

$client = TrakioClient::factory(array(
    'token' => 'YOUR-API-TOKEN'
));

$command = $client->getCommand(
    'identify', 
    array('data' => array('distinct_id' => 123, 'properties' => array('name' => 'Hélder Duarte'))
    )
);

try {
    $response = $client->execute($command);
    var_dump($response);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

## License

MIT License
