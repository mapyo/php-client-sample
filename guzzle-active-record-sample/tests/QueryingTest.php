<?php
use Mockery as m;

class QueryingTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->connection = m::mock('GuzzleActiveSample\Connection');
        $this->message = m::mock('Guzzle\Http\Message\Response');
        $this->model = new QueryModelStub($this->connection);
    }

    public function testTheSingularQueryableName()
    {
        $this->assertEquals('querymodelstub', $this->model->queryableOptions()->singlar());
    }

    public function testThePluralQueryableName()
    {
        $this->assertEquals('the_plural_name', $this->model->queryableOptions()->plural());
    }

    public function testFindOneReturnsOneEntry()
    {
        $stub = file_get_contents(dirname(__FILE__) . '/stubs/stub.json');
        $this->message->shouldReceive('json')->andReturn(json_encode($stub, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $response = $this->model->find(1);

        $this->assertTrue(isset($response['stub']));
    }

    public function testFindAllReturnsAllEntities()
    {
        $stub = file_get_contents(dirname(__FILE__) . '/stubs/stubs.json');
        $this->message->shouldReceive('json')->andReturn(json_encode($stub, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $response = $this->model->all();

        $this->assertTrue(isset($response['stubs']));
    }
}

class QueryModelStub extends \GuzzleActiveSample\Model
{
    protected $queryableOptions = array('plural'=>'the_plural_name');

    public function __construct($connection, $attributes = array())
    {
        parent::__construct($connection);
        $this->fill($attributes);
    }
}
