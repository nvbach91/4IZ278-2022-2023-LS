<?php
require_once '../../db/Database.php';
require_once '../../db/ProductDB.php';

$productDB = new ProductDB();

$category = $_POST['category'];
$products = $productDB->getByCategory($category);

header('Content-Type: application/json');

echo json_encode($products);
?>