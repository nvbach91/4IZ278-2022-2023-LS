<?php include './components/header.php'; ?>
<?php require_once './database/ProductsDatabase.php'; ?>

<?php

error_reporting(E_ERROR | E_PARSE);

$url_array =  explode('/', $_SERVER['REQUEST_URI']);

$url = end($url_array);

?>

<?php require './components/product-list.php'; ?>


<?php include './components/footer.php'; ?>