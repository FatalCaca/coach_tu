<?php

require_once('autoload.php');

use Model\User;
use Service\Container;

$authenticationService = Container::get('AuthenticationService');
$user = null;

print("Tapez q pour quitter\n");

while (!$user) {
    $username = readline('Username : ');

    if ($username === 'q') {
        return;
    }

    $password = readline('Password : ');
    $user = $authenticationService->logIn($username, $password);

    if (!$user) {
        print('Login échoué');
        print("\n\n");
    }
}


var_dump($user); die();

?>
