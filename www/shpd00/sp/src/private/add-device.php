<?php
require_once 'DBConnection.php';

// class Person{
// public $name;
// public $age;
// public function __construct($name,$age){
//     $this->name = $name;
//     $this->age = $age;
// }
// 
//require 'add-device-form-check.php';}
//if($registrationIsSuccesful){
//    header("Location: registration-success.php");
//} 
//else{

    if(!empty($_POST)){
        $deviceAdded = true;
        $serial=$_POST['serial'];
        $model=$_POST['model'];
        $key=$_POST['key'];
    
        // //username check
        // if(preg_match_all('/[^a-zA-Z0-9]/',$username)>0){
        //     $usernameError='username can only contain english letters and numbers';
        //     $registrationIsSuccesful = false;
        // }elseif(strlen($username)<4){
        //     $usernameError='username is too short';
        //     $registrationIsSuccesful = false;
        // }elseif($dbcon->checkUsername($username)){
        //     $usernameError='username is already in use';
        //     $registrationIsSuccesful = false;
        // }
    
        // //email check
        // if(strlen($email)<5){
        //     $emailError='Please, enter your email address';
        //     $registrationIsSuccesful = false;
        // }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        //     $emailError='email address is not valid';
        //     $registrationIsSuccesful = false;
        // }elseif($dbcon->checkEmail($email)){
        //     $emailError='email is already in use';
        //     $registrationIsSuccesful = false;
        // }

        echo $dbcon -> addDevice($serial,$model,$key);
    }
    require 'templates/html-start.php';
    include 'add-device-form.php';
    require 'templates/html-end.php';
//}
?>