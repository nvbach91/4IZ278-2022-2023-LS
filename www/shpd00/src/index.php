<?php
require_once 'DBConnection.php';

// class Person{
// public $name;
// public $age;
// public function __construct($name,$age){
//     $this->name = $name;
//     $this->age = $age;
// }
// }
require 'registration-form-check.php';
if($registrationIsSuccesful){
    header("Location: registration-success.php");
} 
else{
    require 'templates/html-start.php';
    include 'registration-form.php';
    require 'templates/html-end.php';
}
?>