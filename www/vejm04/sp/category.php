<?php
session_start();
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
<html lang="en">
<head>
    <title>E-Shop - Category</title>
    <link rel="stylesheet" type="text/css" href="./styles/category.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1><?= $categoryName ?></h1>
    <div class="product-wrapper">
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <h3><?= $product['name'] ?></h3>
                    <a href="productDetail.php?id=<?= $product['id'] ?>">
                        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    </a>
                    <p><?= $product['description'] ?></p>
                    <p>Price: $<?= $product['price'] ?></p>
                    <a href="productDetail.php?id=<?= $product['id'] ?>" class="btn">View Details</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found in this category.</p>
        <?php endif; ?>
    </div>
</body>
</html>
