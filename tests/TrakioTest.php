<?php

use Cossou\Trakio;

class TrakioTest extends \PHPUnit_Framework_TestCase
{

    private $token;

    public function setUp()
    {
        parent::setUp();

        $this->token = "ME-TOKEN";
    }

    public function testInitReturnsClient()
    {
        $client = Trakio::init($this->token);

        $defaultOption = $client->getDefaultOption('headers/X-Token');

        $this->assertInstanceOf('\Cossou\Trakio', $client);
        $this->assertEquals($this->token, $defaultOption);
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
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testIdentifyReturnsException()
    {
        $client = Trakio::init('');

        $client->identify();
    }

    public function testCanSetGetDistinctId()
    {
        $client = Trakio::init($this->token);

        $distinct_id = 123;

        $client->distinct_id($distinct_id);

        $this->assertEquals($distinct_id, $client->distinct_id());
    }

    public function testCanSetGetChannel()
    {
        $client = Trakio::init($this->token);

        $channel = "web";

        $client->channel($channel);

        $this->assertEquals($channel, $client->channel());
    }

    public function testInitWithDistinctId()
    {
        $distinct_id = 123;

        $client = Trakio::init($this->token, array("distinct_id" => $distinct_id));

        $this->assertEquals($client->distinct_id(), $distinct_id);
    }

    public function testInitWithChannel()
    {
        $channel = 123;

        $client = Trakio::init($this->token, array("channel" => $channel));

        $this->assertEquals($client->channel(), $channel);
    }

}
