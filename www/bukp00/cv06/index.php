<?php require './components/header.php'; ?>
<?php require './database/ProductsDatabase.php'; ?>

<?php

error_reporting(E_ERROR | E_PARSE);

$selectedCategory = $_GET['category_id'];

$productsDatabase = new ProductsDatabase();
$product;

if ($selectedCategory) {
  $products = $productsDatabase->fetchByCategory($selectedCategory);
} else {
  $products = $productsDatabase->fetchAll();
}

?>

<?php require './components/product-list.php'; ?>

<?php require './components/footer.php'; ?>