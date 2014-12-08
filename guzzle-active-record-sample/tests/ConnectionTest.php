<?php

class ConnectionTest extends PHPUnit_Framework_TestCase
{
    public function testGetClient()
    {
        $c = new GuzzleActiveSample\Connection('', '');
        $this->assertInstanceOf('Guzzle\Http\Client', $c->client());
    }

}
