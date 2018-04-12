<?php
namespace Model;

class City
{
    protected $id;
    protected $name;
    protected $population;

    public function __construct($name = "noname", $population = 0)
    {
        $this->name = $name;
        $this->population = $population;
    }

    public function __toString()
    {
        return sprintf("%s (%s)", $this->name, $this->id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
