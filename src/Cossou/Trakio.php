<?php

namespace Cossou;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Common\Exception\InvalidArgumentException;

class Trakio extends Client
{
    public static function factory($token, $config = array())
    {
        $default = array('host' => 'api.trak.io/v1', 'https' => true);

        if (empty($token) || is_null($token))
            throw new InvalidArgumentException("Token must not be blank.");

        $config = Collection::fromConfig($config, $default, array());

        $client = new self(($config->get('https') ? 'https://' : 'http://') . $config->get('host'), $config);

        $client->setDefaultOption('headers/X-Token', $token);

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