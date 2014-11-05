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

    protected $attributes = array();
    protected $fillable = array();

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

    protected function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    protected function isFillable($key)
    {
        if (in_array($key, $this->fillable)) return true;
    }

    protected function fillableFromArray(array $attributes)
    {
        if (count($this->fillable) > 0) {
            return array_intersect_key($attributes, array_flip($this->fillable));
        }

        return $attributes;
    }

    protected function fill(array $attributes)
    {
        foreach($this->fillableFromArray($attributes) as $key => $value) {
            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            }
        }
    }

    public function __get($key)
    {
        if(isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        throw new \Exception("{$key} is not a valid property");
    }

    public function __set($key, $value)
    {
        if($this->isFillable($key)) {
            return $this->setAttribute($key, $value);
        }

        throw new \Exception("{$key} is not a valid property");
    }
}