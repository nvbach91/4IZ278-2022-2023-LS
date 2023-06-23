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
require_once 'classes/Order.php';
require_once 'classes/Product.php';
require_once 'classes/User.php';
require_once 'classes/Admin.php';
require_once 'email.php';

$db = new Database();
$orderObj = new Order($db);
$productObj = new Product($db);
$userObj = new User($db);
$adminObj = new Admin($orderObj, $productObj, $userObj);


$adminObj->cancelOrder($order_id);

$to = $user['email'];
$subject = "Testing PHP Mail";
$message = "Vaša objednávka č. " . $order_id . " žial bola zrušená. Nesplnili ste podmienky.";
$from = "example@vse.cz";

if(!sendEmail($to, $subject, $message, $from)) {
    echo "Email sa nepodarilo odoslať.";
}

header('Location: admin.php');
?>
