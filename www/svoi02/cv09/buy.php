<?php require_once './ProductsDatabase.php'; ?>

<?php
session_start();



if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // check if it exists in our database
    $productDatabase = new ProductDatabase();
    $isExistingProduct = $productDatabase->checkIfProductExists($productId);
    
    if ($isExistingProduct) {

        if (!isset($_SESSION['selected_products'])) {
            $_SESSION['selected_products'] = [$productId];
        } else {
            array_push($_SESSION['selected_products'], $productId);
        }

        header('Location: ./cart.php');
    } else {
        var_dump('ERROR: PRODUCT NOT FOUND');
    }
}

?>