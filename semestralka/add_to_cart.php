<?php
session_start();

include 'database.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare('SELECT * FROM products WHERE product_id = ?');
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();

    if ($product) {
        $cartItem = [
            'product_id' => $product['product_id'],
            'product_name' => $product['product_name'],
            'price' => $product['price'],
            'quantity' => 1
            
        ];

        if (!isset($_SESSION['shopping_cart'])) {
            $_SESSION['shopping_cart'] = [];
            
        }

        $_SESSION['shopping_cart'][] = $cartItem;

        header('Location: shopping_cart.php');
        exit;
    }
}

header('Location: shopping_cart.php');
exit;
?>
