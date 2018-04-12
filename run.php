<?php

require_once('autoload.php');

use Model\User;
use Service\Container;
use Utils\Console;
use Controller\LobbyController;

$authenticationService = Container::get('AuthenticationService');
$user = null;

Console::writeLine("Tapez q pour quitter");

while (!$user) {
    $username = Console::read('Username : ');

    if ($username === 'q') {
        return;
    }

    $password = Console::read('Password : ');
    $user = $authenticationService->logIn($username, $password);

    if (!$user) {
        Console::writeLine('Login échoué');
    }
}

$lobbyController = new LobbyController();
$lobbyController->mainMenu();

?>
