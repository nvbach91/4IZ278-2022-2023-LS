<?php
$host = 'localhost';
$dbName = 'vejm04';
$username = 'root';
$password = ''; //aiphirah9atooMah3o

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}