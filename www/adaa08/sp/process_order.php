<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Cart.php';
require_once 'classes/Order.php';
require_once 'classes/Product.php';
require_once 'classes/Address.php';

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

$city = htmlspecialchars(trim($_POST['city']));
$postal_code = htmlspecialchars(trim($_POST['postal_code']));
$street_plus_number = htmlspecialchars(trim($_POST['street_plus_number']));
$country = htmlspecialchars(trim($_POST['country']));

$address_id = $address->createAddress($city, $postal_code, $street_plus_number, $country, $_SESSION['user_id']);

$cartItems = $cart->getCartItems($_SESSION['cart_id']);

foreach ($orderItems as $item) {
    $product->updateProductStock($item['product_id'], $item['quantity']);
}

// Calculate the total price
$total = 0;
foreach ($cartItems as $item) {
    $productDetails = $product->getProductById($item['product_id']);
    $total += $productDetails['price'] * $item['quantity'];
}

$status = 'Spracováva sa';
$order_id = $order->createOrder($_SESSION['user_id'], $address_id, $total, $status);

foreach ($cartItems as $item) {
    $product->updateProductStock($item['product_id'], $item['quantity']);
    $order->createOrderItem($order_id, $item['product_id'], $item['quantity'], $productDetails['price']);

}

$cart->deleteCart($_SESSION['cart_id']);

if(isset($_SESSION['user_id'])) {
    $newCartId = $cart->createCart($_SESSION['user_id']); 
    $_SESSION['cart_id'] = $newCartId;
} else {
    echo "User is not logged in.";
    // handle this situation appropriately
}



// Email section
$userDetails = $user->getUser($_SESSION['user_id']);
$adminEmail = 'adaa08@vse.cz';

// Send email to the user after order is placed
$to = $userDetails['email']; // User's email
$subject = "Potvrdenie objednávky";
$message = "Ďakujeme za objednávku. Pracujeme na jej vybavení.";
$headers = "From: noreply@example.com" . "\r\n" .
    "Reply-To: noreply@example.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

mail($to, $subject, $message, $headers);

// Send email to the admin
$toAdmin = $adminEmail;
$subjectAdmin = "Nová objednávka";
$messageAdmin = "Nová objednávka bola vytvorená.";
$headersAdmin = "From: noreply@example.com" . "\r\n" .
    "Reply-To: noreply@example.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

mail($toAdmin, $subjectAdmin, $messageAdmin, $headersAdmin);


// Redirect to the order success page
header('Location: order_success.php');
?>