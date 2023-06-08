<?php
require_once '../model/users.php';

@session_start();

@$user = fetchUserByEmail($_SESSION['user_email']);

if (!isset($_SESSION['user_email'])) {
    $_SESSION['user_email'] = 'visitor';
    $_SESSION['account_level'] = 0;
    $user = 0;
}