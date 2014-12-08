<?php
namespace GuzzleActiveSample;

class Party extends Model
{
    /**
     * The model's queryable options
     *
     * @var array
     */
    protected $queryableOptions = array(
        'plural' => 'party',
    );

    /**
     * The model's serializble config
     *
     * @var array
     */
    protected $serializableConfig = array(
        'root' => array('person', 'organisation')
    );

    /**
     * The model's child classes
     *
     * @return array
     */
    public function childClasses()
    {
        return array('person', 'organisation');
    }

    /**
     * Create a new instance of the model
     *
     * @param  PhilipBrown\CapsuleCRM\Connection $connection
     * @return void
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;

        // $this->hasMany('tasks');
    }
}
