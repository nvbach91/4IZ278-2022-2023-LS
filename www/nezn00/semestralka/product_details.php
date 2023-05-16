<?php
include 'database.php';

$category_id = $_GET['category_id'];

$stmt = $conn->prepare('SELECT * FROM products WHERE category_id = ?');

$stmt->execute([$category_id]);


$products = $stmt->fetchAll();


if ($products) {
    foreach ($products as $product) {
        echo '<div>';
        echo '<h1>' . $product['product_name'] . '</h1>';
        echo '<div style="display: flex; align-items: center;">';
        echo '<img src="' . $product['image'] . '" alt="' . $product['product_name'] . '" style="width: 200px; margin-right: 20px;">';
        echo '<div>';
        echo '<p><strong>Price:</strong> $' . $product['price'] . '</p>';
        echo '<p><strong>Stock Quantity:</strong> ' . $product['stock_quantity'] . '</p>';
        echo '<p><strong>Description:</strong></p>';
        echo '<p>' . $product['description'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No products found in this category.';
}
?>

