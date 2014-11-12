<?php
namespace GuzzleActiveSample;

class Product extends Model
{

    protected $fillable = array(
        '' => '',
        );

    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }
}
