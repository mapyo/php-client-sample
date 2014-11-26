<?php

use Mockery as m;
use GuzzleActiveSample\Party;

class PartyTest extends PHPUnit_Framework_TestCase
{
    private $connection;
    private $party;
    private $message;

    public function setUp()
    {
        $this->connection = m::mock('GuzzleActiveSample\Connection');
        $this->party = new Party($this->connection);
        $this->message = m::mock('Guzzle\Http\Message\Response');
    }

    /** @test */
    public function find_party_by_id()
    {
        $response = file_get_contents(dirname(__FILE__) . '/stubs/party.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $party = $this->party->find(100);
        $this->assertInstanceOf('GuzzleActiveSample\Person', $party);
    }
}
