<?php

namespace Cossou;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Common\Exception\InvalidArgumentException;

class Trakio extends Client
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

        $client->setDescription(ServiceDescription::factory(__DIR__.'/Resources/config/client.json'));

        return $client;
    }

    public function identify($data = null)
    {
        $command = $this->getCommand('identify', array('data' => $data));

        try {
            $response = $this->execute($command);
            return $response;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function alias($data = null)
    {
        $command = $this->getCommand('alias', array('data' => $data));

        try {
            $response = $this->execute($command);
            return $response;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function track($data = null)
    {
        $command = $this->getCommand('track', array('data' => $data));

        try {
            $response = $this->execute($command);
            return $response;
        } catch(Exception $e) {
            return $e;
        }
    }


    public function annotate($data = null)
    {
        $command = $this->getCommand('annotate', array('data' => $data));

        try {
            $response = $this->execute($command);
            return $response;
        } catch(Exception $e) {
            return $e;
        }
    }
}