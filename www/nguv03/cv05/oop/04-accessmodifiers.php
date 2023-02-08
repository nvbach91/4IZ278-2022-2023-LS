<?php

class Person {
    public $name = "";
    private $age;
}

$jane = new Person();
$jane->name = "Jane";

// can't do this since it's private
// $p->age = 17;

echo $jane->name, PHP_EOL;





?>