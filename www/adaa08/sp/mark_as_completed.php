<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['order_id'])) {
    die('Missing order_id parameter');
}

$order_id = $_GET['order_id'];

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Order.php';

$db = new Database();
$orderObj = new Order($db);
$userObj = new User($db);

// Mark the order as completed
if ($orderObj->updateOrderStatus($order_id, "Vybavená")) {
    // Get user email
    $email = $userObj->getUserEmailByOrderId($order_id);

    if ($email) {
        // Compose the email
        $to = $email;
        $subject = "Order Update";
        $message = "Your order (Order ID: " . $order_id . ") has been processed and is on its way.";
        $headers = "From: noreply@example.com" . "\r\n" .
            "Reply-To: noreply@example.com" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();
        
        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            header('Location: admin.php');
            exit();
        } else {
            echo "Email could not be sent.";
        }
    } else {
        echo "Could not find user email.";
    }
} else {
    echo "Could not update order status.";
}
    // Redirect back to admin page
header('Location: admin.php');

?>