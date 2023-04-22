<?php
session_start();
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    // check against database
    $isExistingProduct = true;
    if ($isExistingProduct) {
        if (!isset($_SESSION['selected_products'])) {
            $_SESSION['selected_products'] = [$productId];
        } else {
            array_push($_SESSION['selected_products'], $productId);
        }
        header('Location: ./index.php');
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
    <!-- vytvorte stranku pro vymaz obsahu kosiku -->
    <a href="./clear-cart.php">Remove items from cart</a>
</body>
</html>