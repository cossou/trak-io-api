<?php

namespace Cossou\TrakioApiClient\Tests\Client;

use Cossou\TrakioApiClient\Client\TrakioClient;

class TrakioClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $token
     *
     * @dataProvider provideConfigValues
     */
    public function testFactoryReturnsClient($token)
    {
        $config = array(
            'token' => $token,
        );

        $client = TrakioClient::factory($config);

        $this->assertInstanceOf('\Cossou\TrakioApiClient\Client\TrakioClient', $client);
        $this->assertEquals($config['token'], $client->getDefaultOption('headers/X-Token')['token']);
    }

    /**
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testFactoryReturnsExceptionOnNullArguments()
    {
        $config = array();

        $client = TrakioClient::factory($config);
    }

    /**
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testFactoryReturnsExceptionOnBlankArguments()
    {
        $config = array(
            'token' => ''
        );

        $client = TrakioClient::factory($config);
    }


    public function provideConfigValues()
    {
        return array(
            array('token')
        );
    }
}
