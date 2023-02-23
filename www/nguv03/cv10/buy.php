<?php

require 'db.php';
require 'user_required.php'; // pristup jen pro prihlaseneho uzivatele

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
$stmt->execute([
    'id' => $_GET['id']
]);
$products = $stmt->fetch();

if (!$products) {
    exit('Unable to find products!');
}

$_SESSION['cart'][] = $products['id'];

header('Location: cart.php');

?>
