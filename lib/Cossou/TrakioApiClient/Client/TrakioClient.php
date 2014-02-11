<?php

namespace Cossou\TrakioApiClient\Client;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Common\Exception\InvalidArgumentException;

class TrakioClient extends Client
{
    public static function factory($config = array())
    {
        $default = array('base_url' => 'https://api.trak.io/v1');

        $required = array(
            'token',
        );

        foreach ($required as $value) {
            if (empty($config[$value])) {
                throw new InvalidArgumentException("Argument '{$value}' must not be blank.");
            }
        }

        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('base_url'), $config);

        $client->setDefaultOption('headers/X-Token', $config['token']);

        $client->setDescription(ServiceDescription::factory(__DIR__.'/../Resources/config/client.json'));

        return $client;
    }
}