<?php
    setcookie('email', '', time());
    setcookie('facebook', '', time());
    header('Location: index.php');
    exit;
?>