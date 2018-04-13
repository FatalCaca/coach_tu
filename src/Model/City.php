<?php
namespace Model;

class City
{
    protected $id;
    protected $nom;
    protected $population;

    public function __construct($nom = "noname", $population = 0)
    {
        $this->nom = $nom;
        $this->population = $population;
    }

    public function __toString()
    {
        return sprintf("%s (%s)", $this->nom, $this->id);
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

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

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
