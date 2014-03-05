<?php

namespace Cossou;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Common\Exception\InvalidArgumentException;

class Trakio extends Client
{
    private $distinct_id = null;
    private $channel = null;

    public static function init($token, $config = array())
    {
        if (empty($token) || is_null($token))
        {
            throw new InvalidArgumentException("Token must not be blank.");
        }

        $config['token'] = $token;

        return self::factory($config);
    }

    public static function factory($config = array())
    {
        $default = array('host' => 'api.trak.io/v1', 'https' => true);

        $config = array_merge($config, $default);

        $required = array('token', 'host', 'https');

        self::validate($required, $config);

        $config = Collection::fromConfig($config, $default, $required);

        $client = new self(($config->get('https') ? 'https://' : 'http://') . $config->get('host'), $config);

        $client->setDefaultOption('headers/X-Token', $config->get('token'));

        $config->hasKey('distinct_id') ? $client->distinct_id($config->get('distinct_id')) : null;

        $config->hasKey('channel') ? $client->channel($config->get('channel')) : null;

        $client->setDescription(ServiceDescription::factory(__DIR__.'/Resources/config/client.json'));

        return $client;
    }

    public function identify($data = null)
    {
        $data = $this->inject_distinct_id($data);

        $required = array('distinct_id', 'properties');

        self::validate($required, $data);

        $command = $this->getCommand('identify', array('data' => $data));

        try
        {
            $response = $this->execute($command);
            return $response;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public function alias($data = null)
    {
        $data = $this->inject_distinct_id($data);

        $required = array('distinct_id', 'event');

        self::validate($required, $data);

        $command = $this->getCommand('alias', array('data' => $data));

        try
        {
            $response = $this->execute($command);
            return $response;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public function track($data = null)
    {
        $data = $this->inject_distinct_id($data)->inject_channel($data);

        $required = array('distinct_id', 'event');

        self::validate($required, $data);

        $command = $this->getCommand('track', array('data' => $data));

        try
        {
            $response = $this->execute($command);
            return $response;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public function annotate($data = null)
    {
        $data = $this->inject_channel($data);

        $required = array('event', 'channel');

        self::validate($required, $data);

        $command = $this->getCommand('annotate', array('data' => $data));

        try
        {
            $response = $this->execute($command);
            return $response;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public function distinct_id($distinct_id = null)
    {
        if(is_null($distinct_id))
        {
            return $this->distinct_id;
        }

        $this->distinct_id = $distinct_id;
    }

    public function channel($channel = null)
    {
        if(is_null($channel))
        {
            return $this->channel;
        }

        $this->channel = $channel;
    }

    private function inject_distinct_id($data)
    {
        if(!isset($data['distinct_id']) && !is_null($this->distinct_id))
        {
            $data['distinct_id'] = $this->distinct_id;
        }

        return $data;
    }

    private function inject_channel($data)
    {
        if(!isset($data['channel']) && !is_null($this->channel))
        {
            $data['channel'] = $this->channel;
        }

        return $data;
    }

    private static function validate($required, $data)
    {
        foreach ($required as $value)
        {
            if (empty($data[$value]))
            {
                throw new InvalidArgumentException("Argument '{$value}' must not be blank.");
            }
        }
    }
}
