<?php
require_once 'db.php';


function fetchProductsByCart($ids, $question_marks)
{
    $db = newDB();
    $stmt = $db->prepare("SELECT * FROM products WHERE product_id IN ($question_marks) ORDER BY name");
    $stmt->execute(array_values($ids));
    $products = $stmt->fetchAll();
    return $products;
}

function fetchSumByCart($ids, $question_marks)
{
    $db = newDB();
    $stmt = $db->prepare("SELECT SUM(price) FROM products WHERE product_id IN ($question_marks)");
    $stmt->execute(array_values($ids));
    $sum = $stmt->fetchColumn();
    return $sum;
}

function insertOrder($address, $email)
{
    $db = newDB();
    $stmt = $db->prepare("INSERT INTO orders (address, email) VALUES (:address, :email)");
    $stmt->execute([
        'address' => $address,
        'email' => $email
    ]);
}

function insertOrderItems($products) {
    $db = newDB();
    $stmt = $db->prepare("SELECT max(order_id) FROM orders");
    $stmt->execute();

    $order_id = $stmt->fetchColumn();

    echo $order_id;

    foreach ($products as $product) {
        $db = newDB();
        $stmt = $db->prepare("INSERT INTO order_items (price, order_id, product_id) VALUES (:price, :order_id, :product_id)");
        $stmt->execute([
            "price" => $product['price'],
            "order_id" => $order_id,
            "product_id" => $product['product_id']
        ]);
    }
}