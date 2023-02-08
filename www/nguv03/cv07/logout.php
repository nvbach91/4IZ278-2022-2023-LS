<?php
//session_start();
//session_destroy();


// logout by destroying cookie
setcookie('name', '', time());
header('Location: index.php');
?>