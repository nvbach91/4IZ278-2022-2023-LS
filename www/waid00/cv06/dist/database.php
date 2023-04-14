<?php
// Replace the database credentials with your own
$host = 'localhost';
$dbname = 'eshop';
$username = 'root';
$password = '';

// Create a PDO object to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
