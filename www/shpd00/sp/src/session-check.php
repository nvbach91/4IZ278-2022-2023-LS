<?php
require_once 'DBConnection.php';
if  (       isset($_COOKIE['username']) 
        &&  isset($_COOKIE['token'])
    ){
    if($dbcon ->verifySession($_COOKIE['username'],$_COOKIE['token'])){
        $sessionIsValid = true;
    }else{
        setcookie('username','',time()-1);
        setcookie('token','',time()-1);
        $sessionIsValid = false;
    }
}else{
    $sessionIsValid = false;
}
?>