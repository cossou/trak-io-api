<?php

use Cossou\Trakio;

class TrakioTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $token
     *
     * @dataProvider provideConfigValues
     */
    public function testInitReturnsClient($token)
    {

        $client = Trakio::init($token, array());

        $defaultOption = $client->getDefaultOption('headers/X-Token');

        $this->assertInstanceOf('\Cossou\Trakio', $client);
        $this->assertEquals($token, $defaultOption['token']);
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
    public function testInitReturnsExceptionOnNullArguments()
    {
        $config = array();

        $client = Trakio::init($config);
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

    /**
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testInitReturnsExceptionOnBlankArguments()
    {
        $token = '';

        $client = Trakio::init($token);
    }

    /**
     * @param $token
     *
     * @dataProvider provideConfigValues
     *
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testIdentifyReturnsException($token)
    {
        $client = Trakio::init($token);

        $client->identify();
    }


    public function provideConfigValues()
    {
        return 'iamatoken';
    }
}
