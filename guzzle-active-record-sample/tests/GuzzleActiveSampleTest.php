<?php
use Mockery as m;

class GuzzleActiveSampleTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $connection = m::mock('GuzzleActiveSample\Connection');
        $this->guzzleActive = new GuzzleActiveSample\GuzzleActiveSample($connection);
    }

    /**
     * @expectedException Exception
     */
    public function testGuzzleActiveSample()
    {
        $c = new GuzzleActiveSample\GuzzleActiveSample('');
    }

    public function testCreateNewUserModel()
    {
        $this->assertInstanceOf('GuzzleActiveSample\User', $this->guzzleActive->user());
    }

}