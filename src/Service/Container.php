<?php
namespace Service;

class Container
{
    static $services;

    public static function get($serviceName)
    {
        $serviceName = 'Service\\' . $serviceName;

        if (!isset(self::$services[$serviceName])) {
            $service = new $serviceName();
            self::$services[$serviceName] = $service;
        }

        return self::$services[$serviceName];
    }
}?>
