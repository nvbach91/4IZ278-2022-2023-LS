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

    if($loginIsSuccesful){
        $loginIsSuccesful = $dbcon -> loginUser($username,$password);
    }
}    
else{
    $username='';
    $password='';
}
?>