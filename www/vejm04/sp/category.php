<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $queryCategory = "SELECT name FROM categories WHERE id = :categoryId";
    $stmt = $pdo->prepare($queryCategory);
    $stmt->execute(['categoryId' => $categoryId]);
    $categoryName = $stmt->fetchColumn();

    $queryProducts = "SELECT p.* FROM products AS p
                      JOIN product_categories AS pc ON pc.product_id = p.id
                      WHERE pc.category_id = :categoryId";
    $stmt = $pdo->prepare($queryProducts);
    $stmt->execute(['categoryId' => $categoryId]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-Shop - Category</title>
    <link rel="stylesheet" type="text/css" href="./styles/category.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1><?php echo $categoryName; ?></h1>
    <div class="product-wrapper">
        <?php
        if (count($products) > 0) {
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
        } else {
            echo '<p>No products found in this category.</p>';
        }
        ?>
    </div>
</body>
</html>