<?php

if (isset($_GET['action'])) {
    require_once('../database/loadData.php');

    if ($_GET['action'] == "insert") {
        $productsDatabase->insertProduct($_GET['name'], $_GET['category'], $_GET['price'], $_GET['image']);
    } else {
        $productsDatabase->editProduct($_GET['product_id'], $_GET['name'], $_GET['category'], $_GET['price'], $_GET['image']);
    }
    
} else {
    header("refresh:0;url=productManager.php");
}

?>
