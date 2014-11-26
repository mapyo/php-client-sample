<?php
namespace GuzzleActiveSample;

class Person extends Party
{
    /**
     * The model's validation rules
     *
     * @param array
     */
    protected $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
    );

    /**
     * The model's fillable attributes
     *
     * @var array
     */
    protected $fillable = array(
        'id',
        'title',
        'first_name',
        'last_name',
        'job_title',
        'organisation_name',
        'about',
        'created_on',
        'updated_on',
    );

    /**
     * The model's serializble config
     *
     * @var array
     */
    protected $serializableConfig = array(
        'collection_root' => 'parties',
        'additional_methods' => array('contacts'),
    );

    /**
     * Create a new instance of the model
     *
     * @param  PhilipBrown\CapsuleCRM\Connection $connection
     * @param  array                             $attributes;
     * @return void
     */
    public function __construct(Connection $connection, array $attributes = array())
    {
        parent::__construct($connection);

        $this->fill($attributes);

        // $this->contacts = new Contacts();

        // $this->persistableConfig = array(
        //     'create' => function ($this) { return 'person'; },
        //     'delete' => function ($this) { return "party/$this->id"; },
        // );

        // $this->belongsTo('organisation');
    }
}
