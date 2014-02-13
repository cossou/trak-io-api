<?php

use Cossou\TrakioApiClient\Client\TrakioClient;

class TrakioTest extends \PHPUnit_Framework_TestCase
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

        $defaultOption = $client->getDefaultOption('headers/X-Token');

        $this->assertInstanceOf('\Cossou\TrakioApiClient\Client\TrakioClient', $client);
        $this->assertEquals($config['token'], $defaultOption['token']);
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
        return 'iamatoken';
    }
}
