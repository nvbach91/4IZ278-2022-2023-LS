<?php
require_once 'DBConnection.php';

$loginIsSuccesful = false;
if(!empty($_POST)){
    $loginIsSuccesful = true;
    $username=$_POST['username'];
    $password=$_POST['password'];

    //username check
    if(preg_match_all('/[^a-zA-Z0-9]/',$username)>0){
        $usernameError='username can only contain english letters and numbers';
        $loginIsSuccesful = false;
    }elseif(!$dbcon->checkUsername($username)){
        $usernameError='user not found';
        $loginIsSuccesful = false;
    }

    //login
    if($loginIsSuccesful){
        $loginResult = $dbcon -> loginUser($username,$password);
        $loginIsSuccesful = $loginResult[0];
        if($loginIsSuccesful == 0){
            $loginError = $loginResult[1];
        }
    }
}
else{
    $username='';
    $password='';
}
?>