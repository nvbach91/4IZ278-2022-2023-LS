<?php
require_once 'config.php';

$queryProducts = "SELECT * FROM products";
$products = $pdo->query($queryProducts)->fetchAll(PDO::FETCH_ASSOC);

$queryCategories = "SELECT * FROM categories";
$categories = $pdo->query($queryCategories)->fetchAll(PDO::FETCH_ASSOC);

function displayProducts($products)
{
    foreach ($products as $product) {
        echo '<div class="product">';
        echo '<h3>' . $product['name'] . '</h3>';
        echo '<a href="product_detail.php?id=' . $product['id'] . '">';
        echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '">';
        echo '</a>';
        echo '<p>' . $product['description'] . '</p>';
        echo '<p>Price: $' . $product['price'] . '</p>';
        echo '<a href="product_detail.php?id=' . $product['id'] . '" class="btn">View Details</a>';
        echo '</div>';
    }
}

function displayCategories($categories)
{
    foreach ($categories as $category) {
        echo '<div class="category">';
        echo '<a href="category.php?id=' . $category['id'] . '">';
        echo '<h3>' . $category['name'] . '</h3>';
        echo '</a>';
        echo '</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-Shop</title>
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Welcome to E-Shop</h1>
    <h2>Categories</h2>
    <div class="category-wrapper">
        <?php displayCategories($categories); ?>
    </div>
    <h2>Products</h2>
    <div class="product-wrapper">
        <?php displayProducts($products); ?>
    </div>
</body>
</html>