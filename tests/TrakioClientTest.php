<?php

use Cossou\Trakio;

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

        $this->assertInstanceOf('\Cossou\Trakio', $client);
        $this->assertEquals($config['token'], $defaultOption['token']);
    }

    /**
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testFactoryReturnsExceptionOnNullArguments()
    {
        $config = array();

        $client = Trakio::factory($config);
    }

    /**
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testFactoryReturnsExceptionOnBlankArguments()
    {
        $config = array(
            'token' => ''
        );

        $client = Trakio::factory($config);
    }


    public function provideConfigValues()
    {
        return 'iamatoken';
    }
}
