<?php
namespace Service;

use Model\User;

class UserService
{
    const USER_FILEPATH = 'db/users.csv';

    protected $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function getUsers()
    {
        if (!$this->users) {
            $this->loadUsers();
        }

        return $this->users;
    }

    public function loadUsers()
    {
        $csvReader = new CsvReader(self::USER_FILEPATH);
        $content = $csvReader->getContent();

        $firstRow = array_shift($content);
        $settersToCall = [];

        foreach ($firstRow as $attributeName) {
            $settersToCall[] = 'set' . ucfirst($attributeName);
        }

        foreach ($content as $row) {
            $user = new User();

            foreach ($row as $index => $attributeValue) {
                $setterToCall = $settersToCall[$index];
                $user->$setterToCall($attributeValue);
            }

            $this->users[] = $user;
        }
    }

    public function getUserFromName($name)
    {
        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user->getName() === $name) {
                return $user;
            }
        }

        return null;
    }

    public function getUserFromId($id)
    {
        $users = $this->getUsers();

        if (!isset($users[$id])) {
            return null;
        }

        return $users[$id];
    }
}
?>
