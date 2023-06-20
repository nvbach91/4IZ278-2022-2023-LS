<?php
session_start();
require_once 'config.php';

if (
    isset($_POST['product']) && isset($_POST['quantity']) && isset($_POST['total_price']) &&
    isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['address']) &&
    isset($_POST['city']) && isset($_POST['zip_code']) && isset($_POST['email'])
) {
    $productIds = $_POST['product'];
    $quantities = $_POST['quantity'];
    $totalPrice = $_POST['total_price'];

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipCode = $_POST['zip_code'];
    $email = $_POST['email'];

    $queryUser = "SELECT * FROM users WHERE email = :email";
    $stmtUser = $pdo->prepare($queryUser);
    $stmtUser->execute(['email' => $email]);
    $resultUser = $stmtUser->fetch(PDO::FETCH_ASSOC);

    $queryInsertOrder = "INSERT INTO orders (user_id, total, date, status) VALUES (:userId, :total, NOW(), 'order sent')";
    $stmtInsertOrder = $pdo->prepare($queryInsertOrder);
    $stmtInsertOrder->execute(['userId' => $resultUser['id'], 'total' => $totalPrice]);
    $orderId = $pdo->lastInsertId();

    for ($i = 0; $i < count($productIds); $i++) {
        $productId = $productIds[$i];
        $quantity = $quantities[$i];

        $queryProduct = "SELECT * FROM products WHERE id = :productId";
        $stmtProduct = $pdo->prepare($queryProduct);
        $stmtProduct->execute(['productId' => $productId]);
        $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);

        if ($product !== false) {
            $price = $product['price'];
            $totalItemPrice = $price * $quantity;

            $queryInsertOrderItem = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:orderId, :productId, :quantity, :price)";
            $stmtInsertOrderItem = $pdo->prepare($queryInsertOrderItem);
            $stmtInsertOrderItem->execute(['orderId' => $orderId, 'productId' => $productId, 'quantity' => $quantity, 'price' => $price]);
        }
    }

    unset($_SESSION['cart']);
    header("Location: thankYou.php");
    exit();
} else {
    header("Location: checkout.php");
    exit();
}