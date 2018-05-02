<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Service\UserService;
use Service\Container;

class CityServiceTest extends TestCase
{
    public function testLoadCities()
    {
        $cityService = Container::get('CityService');
        $cityService->loadCities();

        $this->assertEquals($valA, $valB,
            'La moyenne de xxxx devrait être égale à ...,')
    }
}
?>
