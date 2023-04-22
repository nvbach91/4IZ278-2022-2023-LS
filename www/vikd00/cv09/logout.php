<?php 
setcookie('username', '', time());
header('Location: ./index.php');
session_destroy();
?>