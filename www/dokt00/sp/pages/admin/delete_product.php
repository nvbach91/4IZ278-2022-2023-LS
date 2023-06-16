<?php

require_once '../../db/Database.php';
require_once '../../db/ProductDB.php';

$productDB = new ProductDB();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $productDB->deleteProduct($product_id);
}

?>
