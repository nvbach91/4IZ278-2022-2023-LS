<?php
session_start();

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    // check if it exists in our database
    $isExistingProduct = true;
    if ($isExistingProduct) {

        if (!isset($_SESSION['selected_products'])) {
            $_SESSION['selected_products'] = [$productId];
        } else {
            array_push($_SESSION['selected_products'], $productId);
        }

    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($_SESSION['selected_products'] as $product): ?>
        <div>Product ID: <?php echo $product; ?></div>
    <?php endforeach; ?>
</body>
</html>