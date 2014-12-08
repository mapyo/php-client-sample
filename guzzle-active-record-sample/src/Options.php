<?php
namespace GuzzleActiveSample;

class Options
{

    /**
     * The merged array of options
     *
     * @var array
     */
    protected $options;

    /**
     * Create a new Options object
     *
     * @param GuzzleActiveSample\Model
     * @return void
     */
    public function __construct(Model $model)
    {
        $base = array(
            'plural' => $model->base()->lowercase()->plural(),
            'singlar' => $model->base()->lowercase()->singular(),
        );
        $this->options = array_merge($base, $model->getQueryableOptions());
    }

    /**
     * Return the singlar name of the model
     *
     * @return string
     */
    public function singlar()
    {
        return $this->options['singlar'];
    }

    /**
     * Return the plural name of the model
     *
     * @return string
     */
    public function plural()
    {
        return $this->options['plural'];
    }
}
