<?php
namespace GuzzleActiveSample;

class User extends Model
{
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }
}
