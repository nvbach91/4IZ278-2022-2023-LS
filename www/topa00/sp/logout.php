<?php 
require 'config/constants.php';

session_destroy();
header('location: index.php');
die();
?>