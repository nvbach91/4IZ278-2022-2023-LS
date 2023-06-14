<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(2)) ?>
<?php require_once './UserDatabase.php' ?>
<?php

if (isset($_GET['user_to_delete'])) {
    var_dump($_GET['user_to_delete']);
    $userDatabase = new UserDatabase();
    $userToDelete = $_GET['user_to_delete'];
    $userDatabase->deleteUser($userToDelete);

    header('Location: ./admin-edit-users.php');
    exit();
}
