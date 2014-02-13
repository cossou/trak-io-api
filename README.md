# Trak.io Api Client

[![Build Status](https://travis-ci.org/cossou/trak-io-api.png?branch=master)](https://travis-ci.org/cossou/trak-io-api)

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

Documentation: http://docs.trak.io/

## Examples

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

Quick [Alias](http://docs.trak.io/alias.html) example:

```php
$command = $client->getCommand(
    'alias', 
    array('data' => array('distinct_id' => 1, 'alias' => 'cossou@gmail.com')
    )
);

try {
    $response = $client->execute($command);
    var_dump($response);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

Quick [Track](http://docs.trak.io/track.html) example:

```php
$command = $client->getCommand(
    'track', 
    array('data' => array('distinct_id' => 1, 'event' => 'Page view', 'channel' => 'Web site')
    )
);

try {
    $response = $client->execute($command);
    var_dump($response);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

Quick [Annotate](http://docs.trak.io/annotate.html) example:

```php
$command = $client->getCommand(
    'annotate', 
    array('data' => array('event' => 'Deployed update', 'channel' => 'Web site', 'properties' => array('details' => 'Added new super awesome feature!', 'version' => 'V324'))
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
