<?php
namespace Service;

class AuthenticationService
{
    public function logIn($username, $password)
    {
        $userService = Container::get('UserService');
        $user = $userService->getUserFromName($username);

        if (!$user) {
            return null;
        }

        if ($user->getPassword() === $password) {
            return $user;
        }

        return null;
    }
}

?>
