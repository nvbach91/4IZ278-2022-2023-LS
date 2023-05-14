<?php
require_once 'DBConnection.php';

$registrationIsSuccesful = false;
if(!empty($_POST)){
    $registrationIsSuccesful = true;
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    //username check
    if(preg_match_all('/[^a-zA-Z0-9]/',$username)>0){
        $usernameError='username can only contain english letters and numbers';
        $registrationIsSuccesful = false;
    }elseif(strlen($username)<4){
        $usernameError='username is too short';
        $registrationIsSuccesful = false;
    }elseif($dbcon->checkUsername($username)){
        $usernameError='username is already in use';
        $registrationIsSuccesful = false;
    }

    //email check
    if(strlen($email)<5){
        $emailError='Please, enter your email address';
        $registrationIsSuccesful = false;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailError='email address is not valid';
        $registrationIsSuccesful = false;
    }elseif($dbcon->checkEmail($email)){
        $emailError='email is already in use';
        $registrationIsSuccesful = false;
    }

    if($registrationIsSuccesful){
        $dbcon -> registerUser($username,$password,$email);
    }
}    
else{
    $username='';
    $email='';
    $password='';
}
//!empty($_POST)?$username=$_POST['username']:$username='';
?>