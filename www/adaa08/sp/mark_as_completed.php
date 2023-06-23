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
require_once 'email.php';

$db = new Database();
$orderObj = new Order($db);
$userObj = new User($db);

if ($orderObj->updateOrderStatus($order_id, "Vybavená")) {

    $email = $userObj->getUserEmailByOrderId($order_id);

    if ($email) {

        $to = $email;
        $subject = 'Testing PHP Mail'; 
        $message = "Vaša objednávka (Order ID: " . $order_id . ") bola vybevaná a je na ceste ku vám.";
        $from = 'example@vse.cz'; 
        
        if(!sendEmail($to, $subject, $message, $from)) {
                echo "Email sa nepodarilo odoslať.";
        }

    } else {
        echo "Could not update order status.";
    }
} 
header('Location: admin.php');

?>