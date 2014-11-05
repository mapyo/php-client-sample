<?php
namespace GuzzleActiveSample\Meta;

use Illuminate\Support\Pluralizer;

class Name
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function lowercase()
    {
        return new Name(strtolower($this->name));
    }

    public function uppercase()
    {
        return new Name(strtoupper($this->name));
    }

    public function plural()
    {
        return new Name(Pluralizer::plural($this->name));
    }

    public function singular()
    {
        return new Name(Pluralizer::singular($this->name));
    }

    public function __tostring()
    {
        return $this->name;
    }

}
