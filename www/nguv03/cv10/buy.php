<?php

require 'db.php';
require 'user_required.php'; // pristup jen pro prihlaseneho uzivatele

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$stmt = $db->prepare('SELECT * FROM cv10_products WHERE product_id = :product_id');
$stmt->execute([
    'product_id' => $_GET['product_id']
]);
$products = $stmt->fetch();

if (!$products) {
    exit('Unable to find products!');
}

$_SESSION['cart'][] = $products['product_id'];

header('Location: cart.php');

?>
