<?php
session_start();

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];

$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT order_id FROM `order` WHERE user_id = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $order_id = $result->fetch_assoc()['order_id'];
} else {
    $sql = "INSERT INTO `order` (user_id, status) VALUES (?, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $order_id = $conn->insert_id;
}

$sql = "SELECT orderitem_id FROM orderitem WHERE order_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $order_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $sql = "UPDATE orderitem SET quantity = quantity + 1 WHERE orderitem_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $result->fetch_assoc()['orderitem_id']);
    $stmt->execute();
} else {
    $sql = "INSERT INTO orderitem (order_id, product_id, quantity) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $order_id, $product_id);
    $stmt->execute();
}

header("Location: logged_in.php");
?>
