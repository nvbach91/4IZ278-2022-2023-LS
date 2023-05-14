<?php
session_start();

require '../models/UsersDB.php';
require 'authorization.php';

session_destroy();
header('Location: ../views/main.php');
exit();
?>