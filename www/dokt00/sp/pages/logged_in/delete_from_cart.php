<?php
session_start();

$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$product_id = $_POST['product_id'];

$sql = "SELECT order_id FROM `order` WHERE user_id = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if($order) {
    $order_id = $order['order_id'];

    $sql = "DELETE FROM orderitem WHERE product_id = ? AND order_id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('ii', $product_id, $order_id);

    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo json_encode(array('success' => true));
    }else{
        echo json_encode(array('success' => false, 'message' => 'No item to delete'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'No pending order'));
}

$conn->close();
?>
