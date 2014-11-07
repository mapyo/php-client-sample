<?php
use Mockery as m;

class QueryingTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $connection = m::mock('GuzzleActiveSample\Connection');
        $this->model = new QueryModelStub($connection);
    }

    public function testTheSingularQueryableName()
    {
        $this->assertEquals('querymodelstub', $this->model->queryableOptions()->singlar());
    }

    public function testThePluralQueryableName()
    {
        $this->assertEquals('the_plural_name', $this->model->queryableOptions()->plural());
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
