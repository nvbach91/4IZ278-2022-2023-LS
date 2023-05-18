<?php
require('./config/config.php');
require_once ('./db/Database.php');

function saveUser($email, $password) {
    $db = new Database();
    $pdo = $db -> pdo;

    $sql = "INSERT INTO `cv10_users`(`email`, `password`) VALUES (:email, :password)";
    $statement = $pdo -> prepare($sql);
    $statement -> execute([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

}

function fetchUser($email) {
    $db = new Database();
    $pdo = $db -> pdo;

    $sql = "SELECT * FROM `cv10_users` WHERE `email` = :email";
    $statement = $pdo -> prepare($sql);
    $statement -> execute([
        'email' => $email
    ]);
    return $statement -> fetchAll();
}
?>