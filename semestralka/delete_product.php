<?php
include 'database.php';

session_start();


if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}


$product_id = $_GET['id'];


$stmt = $conn->prepare('DELETE FROM products WHERE product_id = ?');
$stmt->execute([$product_id]);


header('Location: admin.php');
exit;
?>
