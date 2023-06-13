<?php
session_start();
include 'database.php';

// zisti či je user lognuty
if (!isset($_SESSION['user_id'])) {
    
    header('Location: login.php');
    exit;
}

// checkne či košik existuje v aktualnej session
if (!isset($_SESSION['shopping_cart']) || empty($_SESSION['shopping_cart'])) {
    
    header('Location: shopping_cart.php');
    exit;
}


$user_id = $_SESSION['user_id'];

// zobere usra z databaze
$stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// spracuje objednavku
$orderData = [
    'user_id' => $user_id,
    'total_amount' => calculateTotalAmount($_SESSION['shopping_cart']),
    'payment_method' => isset($_POST['payment_method']) ? $_POST['payment_method'] : null,
    'shipping_address' => isset($_POST['address']) ? $_POST['address'] : null,
];

// Savne objednavku
$stmt = $conn->prepare('INSERT INTO orders (order_date, user_id, total_amount, payment_method, shipping_address) VALUES (NOW(), ?, ?, ?, ?)');
$stmt->execute([$orderData['user_id'], $orderData['total_amount'], $orderData['payment_method'], $orderData['shipping_address']]);
$order_id = $conn->lastInsertId();

// Savvne order items
foreach ($_SESSION['shopping_cart'] as $cartItem) {
    $stmt = $conn->prepare('INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)');
    $stmt->execute([$order_id, $cartItem['product_id'], $cartItem['quantity']]);
}

// vycisti kosik
unset($_SESSION['shopping_cart']);


header('Location: order_success.php?order_id=' . $order_id);
exit;

// vypocita kolko stoji objednavka dokopy
function calculateTotalAmount($cartItems) {
    $totalAmount = 0;

    foreach ($cartItems as $cartItem) {
        $totalAmount += $cartItem['price'] * $cartItem['quantity'];
    }

    return $totalAmount;
}

?>

