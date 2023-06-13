<?php
require '../models/ProductsDB.php';
require '../models/CategoriesDB.php';

$limit = 4;

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

$productsDatabase = new ProductsDatabase();


if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $products = $productsDatabase->fetchByCategory($category_id);
    $count = $productsDatabase->getCountByCategoryId($category_id);
} else {
    $products = $productsDatabase->fetchAllPagination($limit, $offset);
    $count = $productsDatabase->getCount();
}

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();

$paginationCount = ceil($count / $limit);
