<?php require_once './ProductsDatabase.php'; ?>
<?php


$productDatabase = new ProductDatabase();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    //check if product exists
    $existingProduct = $productDatabase->checkIfProductExists($product_id);

    if ($existingProduct) {
        $productDatabase->deleteProduct($product_id);
    }
}

$message = urldecode('Product successfully deleted.');
header('Location: ./index.php?delete='.$message);

?>


