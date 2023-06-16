<?php
require 'authorization.php';
require 'admin-required.php';

$user_id = $_GET['user_id'];
$user = $usersDatabase->fetchById($user_id);

if(!$user){
    exit(404);
}

$usersDatabase->deleteUser($user_id);
header('Location: ../views/users.php');
