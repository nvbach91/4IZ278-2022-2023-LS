<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Cart.php';
require_once 'classes/Product.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "Prosím prihláste sa pred pokračovaním.";
    echo "<button onclick=\"location.href='login.php'\">Prihlásiť sa</button>";
    exit();
}

$db = new Database();
$cartObj = new Cart($db);
$productObj = new Product($db); 

if (!isset($_SESSION['cart_id'])) {
    $_SESSION['cart_id'] = $cartObj->createCart($_SESSION['user_id']);
}

$cart_id = $_SESSION['cart_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity']; 

if (!isset($product_id)) {
    die('No product ID provided');
}

$product = $productObj->getProductById($product_id);

if ($quantity > $product['q_in_stock']) {
    die('Nemáme také množstvo produktu na sklade.');
}

$cartObj->addToCart($quantity, $product_id, $cart_id);

header('Location: product.php');

$db->close();

?>