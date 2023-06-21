<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Product.php';
require_once 'classes/Category.php';

$db = new Database();
$productObj = new Product($db);
$categoryObj = new Category($db);

$productsPerPage = 9;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$totalProducts = $productObj->getTotalProducts();
$totalPages = ceil($totalProducts / $productsPerPage);

if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
    $categoryId = $_GET['category_id'];
    $products = $productObj->getProductsByCategory($categoryId, $page);
} else {
    $products = $productObj->getProductsPaginated($page);
}

$categories = $categoryObj->getCategories();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Products</title>
    <?php include 'meta.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>

<h2 style="text-align: center;">Produkty</h2>

<form method="get" action="">
<select name="category_id" onchange="this.form.submit()">
    <option value="">Všetky kategórie</option>
    <?php
        foreach ($categories as $category) {
            $selected = '';
            if (isset($_GET['category_id']) && $_GET['category_id'] == $category['category_id']) {
                $selected = 'selected';
            }
            echo "<option $selected value=" . $category['category_id'] . ">" . $category['name'] . "</option>";
        }
    ?>
</select>
</form>

<div class="products">
    <?php
        foreach ($products as $product) {
            echo "<div class='product'>\n";
            echo "<img src='" . $product['photo'] . "' alt='" . $product['name'] . "'/>\n";
            echo "<h3>" . $product['name'] . "</h3>\n";
            echo "<p>Cena: " . $product['price'] . "€</p>\n";
            echo "<p>" . $product['description'] . "</p>\n";
            echo "<form action='add_to_cart.php' method='post'>\n";
            echo "<input type='hidden' name='product_id' value='" . $product['product_id'] . "'>\n";
            
            // Start quantity select
            echo "<select name='quantity'>\n";
            for($i=1; $i<=10; $i++) {
                echo "<option value='".$i."'>".$i."</option>\n";
            }
            echo "</select>\n";
            // End quantity select

            echo "<button type='submit' class='add-to-cart'>Pridať do košíka</button>\n";
            echo "</form>\n";
            echo "</div>\n";
        }
    ?>
</div>


<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="?page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>