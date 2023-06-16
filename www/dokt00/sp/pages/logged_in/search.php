<?php
require_once '../../db/Database.php';
require_once '../../db/ProductDB.php';

$productDB = new ProductDB();

$searchQuery = "%" . $_POST['query'] . "%";
$products = $productDB->search($searchQuery);

header('Content-Type: application/json');
echo json_encode($products);
?>
