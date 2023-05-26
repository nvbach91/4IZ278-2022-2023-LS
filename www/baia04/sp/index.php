<?php
session_start();
require('./config/config.php');
$page = isset($_SESSION['page']) ? $_SESSION['page'] : 'main';
header('Location: ./pages/' . $page . '.php');
exit();
?>