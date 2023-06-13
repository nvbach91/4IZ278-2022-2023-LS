

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="styles/product_styles.css">
    
</head>
<body>
    <div class="container">
        <a class="back-button" href="index.php">Back</a>
        <h1>Product Details</h1>
        
        <?php
        include 'database.php';

        $category_id = $_GET['category_id'];

$stmt = $conn->prepare('SELECT * FROM products WHERE category_id = ?');
$stmt->execute([$category_id]);
$products = $stmt->fetchAll();

if ($products) {
    foreach ($products as $product) {
        echo '<div class="product">';
        echo '<h1>' . $product['product_name'] . '</h1>';
        echo '<div class="product-content">';
        echo '<img src="' . $product['image'] . '" alt="' . $product['product_name'] . '" class="product-image">';
        echo '<div class="product-details">';
        echo '<p><strong>Price:</strong> $' . $product['price'] . '</p>';
        echo '<p><strong>Stock Quantity:</strong> ' . $product['stock_quantity'] . '</p>';
        echo '<p><strong>Description:</strong></p>';
        echo '<p>' . $product['description'] . '</p>';
        echo '<a href="add_to_cart.php?product_id=' . $product['product_id'] . '" class="add-to-cart-button">Add to Cart</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No products found in this category.';
}

        ?>
    </div>
</body>
</html>

