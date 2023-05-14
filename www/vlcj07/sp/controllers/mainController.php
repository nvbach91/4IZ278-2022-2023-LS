<?php 
require '../models/ProductsDB.php';

$limit = 4;

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}
$productsDatabase = new ProductsDatabase();
$products = $productsDatabase->fetchAllPagination($limit, $offset);
$count = $productsDatabase->getCount();

$paginationCount = ceil($count / $limit);
?>