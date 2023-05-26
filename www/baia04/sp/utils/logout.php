<?php
session_start();
$_SESSION['logout'] = true;
header('Location: ../pages/home.php');
exit();
?>