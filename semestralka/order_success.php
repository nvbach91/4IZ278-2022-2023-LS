<?php
session_start();
include 'database.php';


if (!isset($_GET['order_id'])) {
    
    header('Location: error.php');
    exit;
}


$order_id = $_GET['order_id'];


$stmt = $conn->prepare('SELECT * FROM orders WHERE order_id = ?');
$stmt->execute([$order_id]);
$order = $stmt->fetch();


if (!$order || $order['user_id'] !== $_SESSION['user_id']) {
    
    header('Location: error.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="styles/order_succes_style.css">
    
        
        
</head>
<body>
<div class="container">
    <h1>Order Success</h1>
    <?php if ($order) { ?>
        <div class="success-message">
            Your order has been placed successfully. Order ID: <?php echo $order['order_id']; ?>
        </div>
        
    <?php } else { ?>
        <div class="error-message">
            Failed to retrieve order details.
        </div>
    <?php } ?>

    <div class="button-container">
        <a href="index.php" class="back-button">Go Back to Homepage</a>
    </div>
</div>
</body>
</html>
