<?php

session_start();
setcookie('username','',time());
setcookie('admin','',time());
setcookie('user_id','',time());
session_destroy();
header('Location: index.php');

?>