<?php
session_start();
setcookie('username', '', time());
session_destroy();
header('Location: ./index.php');
?>