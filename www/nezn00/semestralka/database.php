<?php
$host = 'https://esotemp.vse.cz/myadmin/';
$db   = 'semestral';
$user = 'nezn00';
$pass = 'eeti9Cheiyiebu4aij';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new Exception('Database connection failed: ' . $e->getMessage());
}
?>
