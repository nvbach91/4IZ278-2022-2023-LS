<?php

class Person {
    public $name;
}

$dave = new Person();
$dave->name = "Dave";

$hope = new Person();
$hope->name = "Hope";

echo $dave->name, PHP_EOL;
echo $hope->name, PHP_EOL;

?>