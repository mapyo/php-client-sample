<?php
namespace GuzzleActiveSample;

class Product extends Model
{
    /**
     * The model's fillable attributes
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'price',
        'stocks',
    );

    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }
}
