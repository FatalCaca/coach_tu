<?php
namespace Utils;

class Console
{
    public static function read($message)
    {
        return readline($message);
    }

    public static function write($message)
    {
        print($message);
    }

    public static function writeLine($message)
    {
        print($message . "\n");
    }

    public static function separator()
    {
        self::writeLine("----------------------------------------------------");
    }
}
?>

