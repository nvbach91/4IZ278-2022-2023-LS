<?php
require_once '../model/db.php';

session_start();

$db = newDB();
$stmt = $db->prepare('SELECT * FROM users WHERE email = :email AND account_level = :account_level LIMIT 1');
@$stmt->execute([
    'email' => $_SESSION['user_email'],
    'account_level' => $_SESSION['account_level']
]);

if (!isset($_SESSION['user_email'])) {
    $_SESSION['user_email'] = 'visitor';
    $_SESSION['account_level'] = 0;
}

$current_user = $stmt->fetchAll();
