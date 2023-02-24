<?php 
require ('./PersonFunctions.php');
require('./Person.php');
$personFunctions= new PersonFunctions();
$people= [];
array_push($people, new Person($personFunctions->createAge("01-10-1997"),$personFunctions->createFullName("Andrei", "Prohliz"),$personFunctions->createNumber("770999888"),true));
array_push($people, new Person($personFunctions->createAge("04-11-1993"), $personFunctions->createFullName("Gregori","Chirkin"),$personFunctions->createNumber("770555999"),false));
array_push($people, new Person($personFunctions->createAge("03-12-1989"),$personFunctions->createFullName("Vasya","Brovkin"),$personFunctions->createNumber("770333000"), true));

?>