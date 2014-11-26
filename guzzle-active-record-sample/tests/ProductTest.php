<?php

use Mockery as m;
use GuzzleActiveSample\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    private $connection;
    private $product;
    private $message;

    public function setUp()
    {
        $this->connection = m::mock('GuzzleActiveSample\Connection');
        $this->product = new Product($this->connection);
        $this->message = m::mock('Guzzle\Http\Message\Response');
    }

    /** @test */
    public function find_product_by_id()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );

        $response = file_get_contents(dirname(__FILE__) . '/stubs/product.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $product = $this->product->find(100);
        $this->assertInstanceOf('GuzzleActiveSample\Product', $product);
    }
}