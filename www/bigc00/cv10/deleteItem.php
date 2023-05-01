<?php
session_start();
require 'db/Database.php';
$db = new Database();
$productID = $_GET['id'];
$sql = "DELETE FROM cv06_products WHERE product_id = :id";
$stmt = $db->pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);

header('Location: websiteIndex.php');
exit();
?>