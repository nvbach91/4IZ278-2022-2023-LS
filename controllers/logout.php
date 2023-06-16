<?php
session_start();

require '../models/UsersDB.php';

session_destroy();
header('Location: ../views/main.php');
exit();
?>