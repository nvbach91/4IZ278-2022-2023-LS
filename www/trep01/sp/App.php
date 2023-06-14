<?php

class App
{
    public static function init() //odchytí chybu kdy aplikace nezná třídu
    {
        spl_autoload_register([__CLASS__, "load"]);
    }

    public static function load($className) //načte třídu ze složky
    {

        if (str_contains($className, 'Repository')) {
            $subDir = '/repository/';
        } elseif (str_contains($className, 'Action')) {
            $subDir = '/action/';
        } else {
            $subDir = '/model/';
        }

        $filePath = __DIR__ . $subDir . $className . ".php";

        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            throw new RuntimeException("Class not found: {$className} " . $filePath);
        }
    }

}