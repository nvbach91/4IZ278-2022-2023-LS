<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Cart.php';


if (!isset($_SESSION['user_id'])) {
    echo "Prosím prihláste sa pred pokračovaním.";
    echo "<button onclick=\"location.href='login.php'\">Prihlásiť sa</button>";
    exit();
}

$db = new Database();
$cartObj = new Cart($db);

// Make sure the user has a cart_id in the session
if (!isset($_SESSION['cart_id'])) {
    $_SESSION['cart_id'] = $cartObj->createCart($_SESSION['user_id']);
}

$cart_id = $_SESSION['cart_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity']; // Get the quantity from POST

// Make sure a product_id was submitted
if (!isset($product_id)) {
    die('No product ID provided');
}

// Insert the product into the cart
$cartObj->addToCart($quantity, $product_id, $cart_id);

// Redirect back to the products page
header('Location: product.php');

// Close the connection
$db->close();

?>
