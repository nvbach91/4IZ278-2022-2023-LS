<?php
require_once 'db.php';

function signin($email)
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll()[0];
    return $existing_user;
}
