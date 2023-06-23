<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Cart.php';
require_once 'classes/Order.php';
require_once 'classes/Product.php';
require_once 'classes/Address.php';
require_once 'classes/Admin.php';  
require_once 'email.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new Database();

$user = new User($db);
$cart = new Cart($db);
$order = new Order($db);
$product = new Product($db);
$address = new Address($db);
$admin = new Admin($order, $product, $user); 

if (!isset($_POST['previous_address'])) {
    $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : "";
    $postal_code = isset($_POST['postal_code']) ? htmlspecialchars(trim($_POST['postal_code'])) : "";
    $street_plus_number = isset($_POST['street_plus_number']) ? htmlspecialchars(trim($_POST['street_plus_number'])) : "";
    $country = isset($_POST['country']) ? htmlspecialchars(trim($_POST['country'])) : "";

    $address_id = $address->createAddress($city, $postal_code, $street_plus_number, $country, $_SESSION['user_id']);
} else {

    $previous_address = $address->getAddress($_POST['previous_address']);
    
    $city = $previous_address['city'];
    $postal_code = $previous_address['postal_code'];
    $street_plus_number = $previous_address['street_plus_number'];
    $country = $previous_address['country'];
    
    $address_id = $address->createAddress($city, $postal_code, $street_plus_number, $country, $_SESSION['user_id']);
}


$cartItems = $cart->getCartItems($_SESSION['cart_id']);

foreach ($cartItems as $item) { 
    $product->updateProductStock($item['product_id'], $item['quantity']);
}

$total = 0;
foreach ($cartItems as $item) {
    $productDetails = $product->getProductById($item['product_id']);
    $total += $productDetails['price'] * $item['quantity'];
}

$status = 'Spracováva sa';
$order_id = $order->createOrder($_SESSION['user_id'], $address_id, $total, $status);

foreach ($cartItems as $item) {
    $product->updateProductStock($item['product_id'], $item['quantity']);
    $productDetails = $product->getProductById($item['product_id']);
    $order->createOrderItem($order_id, $item['product_id'], $item['quantity'], $productDetails['price']);
}

$cart->deleteCart($_SESSION['cart_id']);

if(isset($_SESSION['user_id'])) {
    $newCartId = $cart->createCart($_SESSION['user_id']); 
    $_SESSION['cart_id'] = $newCartId;
} else {
    echo "User is not logged in.";
}

$userDetails = $user->getUser($_SESSION['user_id']);
$admins = $admin->getAdmins();

$to = $userDetails['email']; 
$subject = 'Testing PHP Mail';
$message = "Ďakujeme za objednávku. Pracujeme na jej vybavení.";
$from = 'example@vse.cz'; 

    if(!sendEmail($to, $subject, $message, $from)){
        echo "Email sa nepodarilo odoslať.";
    }

    foreach ($admins as $adminUser) {
        $toAdmin = $adminUser['email'];
        $subjectAdmin = 'Testing PHP Mail';
        $messageAdmin = "Nová objednávka bola vytvorená.";
        $fromAdmin = 'example@vse.cz'; 
        if(!sendEmail($toAdmin, $subjectAdmin, $messageAdmin, $fromAdmin)){
            echo "Failed to send email to the admin";
        }
    }

header('Location: order_success.php');
?>