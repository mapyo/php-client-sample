<?php
use Mockery as m;
use GuzzleActiveSample\Model;
use GuzzleActiveSample\Connection;

class SerializableTest extends PHPUnit_Framework_TestCase
{
    private $connection;
    private $model;

    public function setUp()
    {
        $this->connection = m::mock('GuzzleActiveSample\Connection');
        $this->model = new SerializableModelStub($this->connection);
    }

    public function testShouldGetSerializableOptions()
    {
        $options = $this->model->serializableOptions();

        $this->assertTrue(is_array($options));
        $this->assertTrue(is_array($options['root']));
        $this->assertEquals('serializablemodelstubs', $options['collection_root']);
    }
}

class SerializableModelStub extends Model
{
    protected $serializableConfig = array(
        'root' => array( 'person', 'organisation',),
    );

    public function __construct(Connection $connection, $attributes = array())
    {
        parent::__construct($connection);

        $this->fill($attributes);
    }
}
