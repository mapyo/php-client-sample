<?php
namespace GuzzleActiveSample;

abstract class Model
{
    /**
     * connection
     *
     * @var GuzzleActiveSample\Connection
     */
    protected $connection;

    /**
     * __construct
     *
     * @param  GuzzleActiveSample\Connection $connection
     * @access public
     * @return void
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * connection
     *
     * @access public
     * @return GuzzleActiveSample\Connection
     */
    public function connection()
    {
        return $this->connection;
    }
}
