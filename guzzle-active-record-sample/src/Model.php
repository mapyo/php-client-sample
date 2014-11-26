<?php
namespace GuzzleActiveSample;

use GuzzleActiveSample\Meta\Base;
use Sirius\Validation\Validator;

abstract class Model
{
    /**
     * connection
     *
     * @var GuzzleActiveSample\Connection
     */
    protected $connection;

    protected $validator;
    protected $errors;

    protected $attributes = array();
    protected $fillable = array();

    /**
     * The model's queryable options
     *
     * @var array
     */
    protected $queryableOptions = array();

    /**
     * The model's serializable config
     *
     * @var array
     */
    protected $serializableConfig = array();

    /**
     * An array of serializable options
     *
     * @var array
     */
    protected $serializableOptions;

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
        foreach ($this->fillableFromArray($attributes) as $key => $value) {
            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            }
        }
    }

    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        throw new \Exception("{$key} is not a valid property");
    }

    public function __set($key, $value)
    {
        if ($this->isFillable($key)) {
            return $this->setAttribute($key, $value);
        }

        throw new \Exception("{$key} is not a valid property");
    }

    public function base()
    {
        return new Base($this);
    }

    /**
     * Validate
     *
     * @return bool
     */
    public function validate()
    {
        $validator = new Validator;
        $validator->add($this->rules);

        if ($validator->validate($this->attributes)) {
            return true;
        }

        $this->errors = $validator->getMessages();

        return false;
    }

    /**
     * Return the validation errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->error;
    }

    /**
     * Return the queryable options
     *
     * @return array
     */
    public function getQueryableOptions()
    {
        return $this->queryableOptions;
    }

    public function queryableOptions()
    {
        return new Options($this);
    }

    /**
     * Find a single entity by it's id
     *
     * @param  int  $id
     */
    public function find($id)
    {
        $endpoint = '/v1/' . $this->queryableOptions()->plural() . '/' . $id . '.json';

        $response = $this->connection->get($endpoint);

        return $response->json();
    }

    public function all()
    {
        $endpoint = '/v1/' . $this->queryableOptions()->plural() . '.json';

        $response = $this->connection->get($endpoint);

        $normalizer = new Normalizer($this);

        return $normalizer->model($response);
    }

    /**
     * Return the serializable options
     *
     * @return array
     */
    public function serializableOptions()
    {
        $this->setSerializableOptionArray();
        return array_merge($this->serializableOptions, $this->serializableConfig);
    }

    private function setSerializableOptionArray()
    {
        $this->serializableOptions = array(
            'root' => $this->base()->lowercase()->singular(),
            'collection_root' => $this->base()->lowercase()->plural(),
        );
    }

}
