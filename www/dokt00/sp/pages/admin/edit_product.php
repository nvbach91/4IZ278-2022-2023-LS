<?php

require_once '../../db/Database.php';
require_once '../../db/ProductDB.php';

$productDB = new ProductDB();

if (isset($_POST['product_id']) && isset($_POST['column']) && isset($_POST['value'])) {
    $productID = $_POST['product_id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    $allowed_columns = ['name', 'description', 'price', 'stock', 'image_url'];
    if (!in_array($column, $allowed_columns)) {
        die('Invalid column');
    }

    $productDB->updateProduct($productID, $column, $value);
}

?>
