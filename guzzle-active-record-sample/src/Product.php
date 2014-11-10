<?php
namespace GuzzleActiveSample;

class Product extends Model
{
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }
}
