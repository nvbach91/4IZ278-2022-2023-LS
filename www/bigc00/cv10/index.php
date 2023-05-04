<?php
require('./header.php');
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header('Location: websiteIndex.php');
    exit();
} else {
    require('./includes/main.php');
}
?>