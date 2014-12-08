<?php
namespace GuzzleActiveSample;

class GuzzleActiveSample
{
    /**
     * The HTTP Connection
     *
     * @access protected
     */
    protected $connection;

    /**
     * Create a new instance of GuzzleActiveSample
     *
     * @param  GuzzleActiveSample\Connection $connection
     * @return void
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function product()
    {
        return new Product($this->connection);
    }
}
