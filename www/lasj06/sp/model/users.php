<?php
require_once 'db.php';

function signIn($email)
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll()[0];
    return $existing_user;
}

function signUp($email, $full_name, $password)
{
    $db = newDB();
    $stmt = $db->prepare('INSERT INTO users(email, full_name, password, account_level) VALUES (:email, :full_name, :password, 1)');
    $stmt->execute([
        'email' => $email,
        'full_name' => $full_name,
        'password' => $password,
    ]);
}

function fetchAllUsers()
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT * FROM users');
    $stmt->execute([]);
    $users = @$stmt->fetchAll();
    return $users;
}

function fetchUserByEmail($email)
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute([
        "email" => $email
    ]);
    $user = @$stmt->fetchAll()[0];
    return $user;
}

function updateUser($email)
{
    $db = newDB();
    @$stmt = $db->prepare('UPDATE users SET full_name = :full_name, account_level = :account_level WHERE email = :email');
    $stmt->execute([
        "email" => $email,
        "full_name" => $_POST['full_name'],
        "account_level" => $_POST['account_level'],
    ]);
}