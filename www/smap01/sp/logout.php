<?php

//Sets user_email in _SESSION to "" effectively logging user out
session_start();
if(isset($_COOKIE['user_email'])){
    setcookie("user_email", "", time());
    session_destroy();
    header('Location: ./index.php');
    exit;
}else{
    echo "Cookie is not set.";
}


?>