<?php
namespace GuzzleActiveSample\Meta;

use ReflectionClass;
use GuzzleActiveSample\Model;

class Base
{
    protected $reflection;

    public function __construct(Model $model)
    {
        $this->reflection = new ReflectionClass($model);
    }

    public function lowercase()
    {
        return $this->getNameInstance()->lowercase();
    }

    public function uppercase()
    {
        return $this->getNameInstance()->uppercase();
    }

    public function plural()
    {
        return $this->getNameInstance()->plural();
    }

    public function singular()
    {
        return $this->getNameInstance()->singular();
    }

    public function getNameInstance()
    {
        return new Name($this->reflection->getShortName());
    }
}

