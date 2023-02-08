<?php

class Song {
    function __construct() {
        echo "Song object is created", PHP_EOL;
    }

}
$song = new Song();
print_r($song);

/**
 * Konstruktor v ideálním případě pouze inicializuje objekt. Inicializace objektu znamená 
 * přiřazování počátečních vlastností třídy. Pokud si tedy představíme následující objekt, úloha 
 * konstruktoru je pouze přiřazení vstupních parametrů. Zcela čistý konstruktor nesmí 
 * obsahovat žádnou logiku.
 */
class Friend {
    private $born;
    private $name;

    // why is constructor considered a magic method?
    function __construct($name, $born) {
        $this->name = $name;
        $this->born = $born;
    }

    function getInfo() {
        echo "My friend $this->name was born in $this->born", PHP_EOL;
    }
}

$friend = new Friend("Monika", 1990);
$friend->getInfo();

?>