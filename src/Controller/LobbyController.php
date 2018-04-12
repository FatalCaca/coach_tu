<?php
namespace Controller;

use Utils\Console;
use Service\Container;

class LobbyController
{
    public function mainMenu()
    {
        while (true) {
            Console::separator();
            Console::writeLine("1 - Lister les villes");
            Console::writeLine("2 - Créer une ville");
            Console::writeLine("3 - Éditer une ville");
            Console::writeLine("q - Quitter");

            $action = Console::read("Action : ");

            switch($action) {
            case "1":
                $this->listCity();
                break;
            case "2":
                $this->createCity();
                break;
            case "3":
                $this->editCity();
                break;
            case "q":
                Console::writeLine("tchuss !");
                return;
            default:
                Console::writeLine("Action inconnue");
            }
        }
    }

    public function listCity()
    {
        Console::separator();
        Console::writeLine("Toutes les villes :");

        $cityService = Container::get('CityService');
        $cities = $cityService->getAll();

        $mask = "|%5.5s |%-30.30s |%-10.10s |\n";

        Console::separator();
        printf(
            $mask,
            "Id",
            "Nom",
            "Population"
        );
        Console::separator();

        foreach ($cities as $city) {
            printf(
                $mask,
                $city->getId(),
                $city->getName(),
                $city->getPopulation()
            );
        }
    }

    public function createCity()
    {
        Console::separator();
        Console::writeLine("Créer une nouvelle ville");

        $cityService = Container::get('CityService');
        $city = $cityService->create(
            Console::read("Nom : "),
            Console::read("Population : ")
        );

        if ($cityService->save()) {
            Console::writeLine(sprintf("Ville %s créée !", $city));
        }
        else {
            Console::writeLine("Erreur à la sauvegarde du fichier !");
        }
    }

    public function editCity()
    {
        Console::separator();
        Console::writeLine("Éditer une ville");
        $search = Console::read("Quelle ville ? (id) : ");

        $cityService = Container::get('CityService');

        $city = $cityService->getFromId($search);

        if (!$city) {
            Console::writeLine("Ville inconnue :(");
            return;
        }

        $newName = Console::read(sprintf(
            "Nouveau nom ? (%s) : ",
            $city->getName()
        ));

        $newPopulation = Console::read(sprintf(
            "Nouvelle population ? (%s) : ",
            $city->getPopulation()
        ));

        $city = $cityService->edit($city, $newName, $newPopulation);

        if ($cityService->save()) {
            Console::writeLine(sprintf("Ville %s modifiée !", $city));
        }
        else {
            Console::writeLine("Erreur à la sauvegarde du fichier !");
        }
    }
}
?>
