<?php
session_start();
require_once 'config.php';

$productsPerPage = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

$queryProducts = "SELECT * FROM products LIMIT :limit OFFSET :offset";
$stmtProducts = $pdo->prepare($queryProducts);
$stmtProducts->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
$stmtProducts->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtProducts->execute();
$products = $stmtProducts->fetchAll(PDO::FETCH_ASSOC);

$queryCategories = "SELECT * FROM categories";
$categories = $pdo->query($queryCategories)->fetchAll(PDO::FETCH_ASSOC);

function displayProducts($products)
{
    $output = '';
    foreach ($products as $product) {
        $output .= '<div class="product">';
        $output .= '<h3>' . $product['name'] . '</h3>';
        $output .= '<a href="productDetail.php?id=' . $product['id'] . '">';
        $output .= '<img src="' . $product['image'] . '" alt="' . $product['name'] . '">';
        $output .= '</a>';
        $output .= '<p>' . $product['description'] . '</p>';
        $output .= '<p>Price: $' . $product['price'] . '</p>';
        $output .= '<a href="productDetail.php?id=' . $product['id'] . '" class="btn">View Details</a>';
        $output .= '<form method="post" action="cart.php">';
        $output .= '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
        $output .= '<input type="hidden" name="quantity" value="1">';
        $output .= '<button type="submit" name="add_to_cart" class="btn addToCartBtn">Add to Cart</button>';
        $output .= '</form>';


        $output .= '</div>';
    }
    return $output;
}

function displayCategories($categories)
{
    $output = '';
    foreach ($categories as $category) {
        $output .= '<div class="category">';
        $output .= '<a href="category.php?id=' . $category['id'] . '">';
        $output .= '<h3>' . $category['name'] . '</h3>';
        $output .= '</a>';
        $output .= '</div>';
    }
    return $output;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Shop</title>
    <link rel="stylesheet" type="text/css" href="./styles/common.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Welcome to E-Shop</h1>
    <h2>Categories</h2>
    <div class="category-wrapper">
        <?= displayCategories($categories); ?>
    </div>
    <h2>Products</h2>
    <div class="product-wrapper">
        <?= displayProducts($products); ?>
    </div>
    <div class="pagination">
        <?php
        $queryCount = "SELECT COUNT(*) FROM products";
        $totalProducts = $pdo->query($queryCount)->fetchColumn();
        $totalPages = ceil($totalProducts / $productsPerPage);

        if ($page > 1) {
            $prevPage = $page - 1;
        ?>
            <a href="index.php?page=<?= $prevPage ?>" class="btn btnPage">Previous</a>
        <?php
        }

        if ($page < $totalPages) {
            $nextPage = $page + 1;
        ?>
            <a href="index.php?page=<?= $nextPage ?>" class="btn btnPage">Next</a>
        <?php
        }
        ?>
    </div>
</body>
</html>
