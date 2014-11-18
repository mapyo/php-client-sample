<?php
namespace GuzzleActiveSample;

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
    }

    /**
     * Normalize a collection of models
     *
     * @param  array                         $attributes
     * @return GuzzleActiveSample\Connection
     */
    public function collection(array $attributes)
    {
    }
}
