<?php
session_start();

require './db/db.php';
require 'authorization.php';

session_destroy();
header('Location: index.php');
exit();
?>