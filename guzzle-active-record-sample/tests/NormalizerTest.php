<?php
use Mockery as m;
use GuzzleActiveSample\Model;
use GuzzleActiveSample\Connection;
use GuzzleActiveSample\Normalizer;

class NormalizerTest extends PHPUnit_Framework_TestCase
{
    private $connection;
    private $model;
    private $normalizer;

    public function setUp()
    {
        $this->connection = m::mock('GuzzleActiveSample\Connection');
        $this->model = new NormalizeModelStub($this->connection);
        $this->normalizer = new Normalizer($this->model);
    }

    /** @test */
    public function should_require_model()
    {
        $this->setExpectedException('Exception');
        $normalizer = new Normalizer('', array());
    }

    /** @test */
    public function should_require_option_array()
    {
        $this->setExpectedException('Exception');
        $normalizer = new Normalizer($this->model, '');
    }

    /** @test */
    public function model_method_should_require_attributes_array()
    {
        $this->setExpectedException('Exception');
        $this->normalizer->model();
    }

    /** @test */
    public function collection_should_require_attributes_array()
    {
        $this->setExpectedException('Exception');
        $this->normalizer->collection();
    }
}

class NormalizeModelStub extends Model
{
    public function __construct(Connection $connection, $attributes = array())
    {
        parent::__construct($connection);
        $this->fill($attributes);
    }
}
