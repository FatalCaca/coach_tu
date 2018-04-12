<?php
namespace Model;

class City
{
    protected $name;
    protected $population;

    public function __construct()
    {
        $this->population = 0;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPopulation()
    {
        return $this->population;
    }

    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }
}
?>
