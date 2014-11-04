<?php
use GuzzleActiveSample\Connection;
use GuzzleActiveSample\Model;

class ModelTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->model = new ModelStub(new Connection('',''), array('name' => 'mapyo'));
    }

    public function testConnectionMethodHasConnection()
    {
        $this->assertInstanceOf('GuzzleActiveSample\Connection', $this->model->connection());
    }

    public function testSettingAnArrayOfAttributes()
    {
        $this->assertEquals('mapyo', $this->model->name);
    }

    public function testSettingAProperty()
    {
        $this->model->memo = 'History repeats itself.';
        $this->assertEquals('History repeats itself.', $this->model->memo);
    }
}

class ModelStub extends \GuzzleActiveSample\Model
{
    protected $fillable = array('name', 'memo');

    public function __construct($connection, $attributes = array())
    {
        parent::__construct($connection);
        $this->fill($attributes);
    }
}
