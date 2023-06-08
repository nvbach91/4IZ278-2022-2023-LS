<?php
session_start();

$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

//connection to db
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT order_id FROM `order` WHERE user_id = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
$order_id = $order['order_id'];

if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];

    $sql = "UPDATE orderitem SET quantity = ? WHERE product_id = ? AND order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $quantity, $product_id, $order_id);
    $stmt->execute();
}
?>
