<?php
namespace Service;

use Model\City;

class CityService
{
    const CITIES_FILEPATH = 'db/cities.csv';

    protected $cities;

    public function __construct()
    {
        $this->cities = [];
    }

    public function getAll()
    {
        if (!$this->cities) {
            $this->loadCities();
        }

        return $this->cities;
    }

    public function loadCities()
    {
        $csvReader = new CsvReader(self::CITIES_FILEPATH);
        $content = $csvReader->getContent();

        $firstRow = array_shift($content);
        $settersToCall = [];

        foreach ($firstRow as $attributeName) {
            $settersToCall[] = 'set' . ucfirst($attributeName);
        }

        foreach ($content as $row) {
            $city = new City();

            foreach ($row as $index => $attributeValue) {
                $setterToCall = $settersToCall[$index];
                $city->$setterToCall($attributeValue);
            }

            $this->cities[$city->getId()] = $city;
        }
    }

    public function save()
    {
        $csvReader = new CsvReader(self::CITIES_FILEPATH);
        $content = $csvReader->getContent();
        $firstRow = array_shift($content);

        $fileContent = implode(',', $firstRow) . "\n";

        foreach ($this->getAll() as $city) {
            $fileContent .= implode(
                ',',
                [
                    $city->getId(),
                    $city->getName(),
                    $city->getPopulation()
                ]
            );

            $fileContent .= "\n";
        }

        return file_put_contents(self::CITIES_FILEPATH, $fileContent);
    }

    public function create($name, $population)
    {
        $city = new City($name, $population);
        $city->setId($this->getNextId());
        $this->cities[] = $city;

        return $city;
    }

    public function edit($city, $newName, $newPopulation)
    {
        if (!$city) {
            return null;
        }

        if ($newName) {
            $city->setName($newName);
        }

        if ($newPopulation) {
            $city->setPopulation($newPopulation);
        }

        $this->getAll()[$city->getId()] = $city;

        return $city;
    }

    public function getCityFromName($name)
    {
        $cities = $this->getCities();

        foreach ($cities as $city) {
            if ($city->getName() === $name) {
                return $city;
            }
        }

        return null;
    }

    public function getFromId($id)
    {
        $cities = $this->getAll();

        if (!isset($cities[$id])) {
            return null;
        }

        return $cities[$id];
    }

    public function getNextId()
    {
        $maxId = 0;

        foreach ($this->getAll() as $city) {
            if ($city->getId() > $maxId) {
                $maxId = $city->getId();
            }
        }

        return $maxId + 1;
    }
}
?>
