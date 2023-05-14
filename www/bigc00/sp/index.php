<?php
session_start();
isset($_SESSION['user']) ? header('Location: ./includes/accounts.php') : header('Location: ./includes/main.php');
exit();
?>