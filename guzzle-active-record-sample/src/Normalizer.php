<?php
namespace GuzzleActiveSample;

use Illuminate\Support\Collection;

class Normalizer
{
    /**
     * The Model instance
     *
     * @var GuzzleActiveSample\Model
     */
    protected $model;

    /**
     * The options array
     *
     * @var array
     */
    protected $options;

    /**
     * The root of the entity
     *
     * @var array|string
     */
    protected $root;

    /**
     * Create a new Normalizer instance
     *
     * @param  GuzzleActiveSample\Model $model
     * @param  array                    $options
     * @return void
     */
    public function __construct(Model $model, array $options = array())
    {
        $this->model = $model;
        $this->options = $options;
    }

    /**
     * Normalize a single model
     *
     * @param array $attributes
     * @access GuzzleActiveSample\Model
     */
    public function model(array $attributes)
    {
        if($this->hasSubclasses()) {
            return $this->normalizeSubclass($attributes);
        }
        // return $this->normalizeModel($attributes);
    }

    /**
     * Normalize a collection of models
     *
     * @param  array                         $attributes
     * @return GuzzleActiveSample\Connection
     */
    public function collection(array $attributes)
    {
        if($this->hasSubclasses()) {
            return $this->normalizeSubclassCollection($attributes);
        }

        return $this->normalizeCollection($attributes);
    }

    /**
     * hasSubclasses
     *
     * @return bool
     */
    public function hasSubclasses()
    {
        return is_array($this->root());
    }

    /**
     * Get the root of the entity
     *
     * @return array|string
     */
    public function root()
    {
        if ($this->root) {
            return $this->root;
        }

        if (isset($this->options['root'])) {
            return $this->root = $this->options['root'];
        }

        $options = $this->model->serializableOptions();
        return $this->root = $options['root'];
    }

    /**
     * Normalize a subclass
     *
     * @param array $attributes
     * @return GuzzleActiveSample\Model
     */
    private function normalizeSubclass(array $attributes)
    {
        reset($attributes);
        $key = key($attributes);
        return $this->createNewModelInstance($key, $attributes[$key]);
    }

    /**
     * Create a new model
     *
     * @param string $name
     * @param array $attributes
     * @return GuzzleActiveSample\Model
     */
    private function createNewModelInstance($name, array $attributes)
    {
        $class = ucfirst($name);
        $class = "GuzzleActiveSample\\$class";

        $attributes = Helper::toSnakeCase($attributes);

        return new $class($this->model->connection(), $attributes);
    }

    /**
     * Normalize a subclass collection
     *
     * @param array $attributes
     * @return Illuminate\Support\Collection
     */
    private function normalizeSubclassCollection($attributes)
    {
        $collection = new Collection;
        foreach($attributes[(string)$this->collectionRoot()] as $key => $value) {
            if($this->isAssociativeArray($value)) {
                $collection[] = $this->createNewModelInstance($key, $value);
            } else {
                foreach($value as $attributes) {
                    $collection[] = $this->createNewModelInstance($key, $attributes);
                }
            }
        }

        return $collection;
    }

    /**
     * Get the collection root of the entity
     *
     * @return string
     */
    private function collectionRoot()
    {
        if($this->collection_root) {
            return $this->collection_root;
        }

        if(isset($options['collection_root'])) {
            return $this->collection_root = $options['collection_root'];
        }

        $options = $this->model->serializableOptions();
        return $this->collection_root = $options['collection_root'];
    }

    /**
     * Check to see if the array is associative
     *
     * @param array $array
     * @return bool
     */
    private function isAssociativeArray($array)
    {
        return (bool) count(array_filter(array_keys($array), 'is_string'));
    }
}
