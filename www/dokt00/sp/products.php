<?php

require_once 'db/Database.php';
require_once 'db/ProductDB.php';

$productDB = new ProductDB();

$products = $productDB->getAll();

$productCounter = 0;

if (!empty($products)) {
    echo '<section class="products">';

    foreach ($products as $product) {
        if ($productCounter % 3 == 0 && $productCounter > 0) {
            echo '</section><section class="products">';
        }

        echo '<div class="product">';
        echo '<img src="' . $product["image_url"] . '" alt="' . $product["name"] . '">';
        echo '<h3>' . $product["name"] . '</h3>';
        echo '<p>$' . $product["price"] . '</p>';
        echo '<form method="POST">';
        echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
        echo '<button class="add-to-cart" type="submit">Add to Cart</button>';
        echo '</form>';
        echo '</div>';

        $productCounter++;
    }

    if ($productCounter % 3 != 0) {
        echo '</section>';
    }

} else {
    echo "No products found";
}
