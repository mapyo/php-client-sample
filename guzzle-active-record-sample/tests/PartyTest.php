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
        $this->assertEquals('100', $party->id);
        $this->assertEquals('Eric', $party->first_name);
        $this->assertEquals('Schmidt', $party->last_name);
        $this->assertEquals('2011-09-14T15:22:01Z', $party->created_on);
        $this->assertEquals('2011-12-14T10:45:46Z', $party->updated_on);
    }

}
