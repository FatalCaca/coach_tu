<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Service\UserService;

class CoucouTest extends TestCase
{
    public function testTest()
    {
        $userService = new UserService();
        var_dump($userService->getUsers()); die();
    }
}
?>
