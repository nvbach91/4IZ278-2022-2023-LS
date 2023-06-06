<?php
require_once "../model/products.php";

$error = "";

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (array_key_exists('search', $_POST)) {
        $search = $_POST['search'];
        $searchResult = fetchProductsByName($search);
        if ($searchResult == null) {
            $error = "No game with such a name is avaliable.";
        } else {
            header('Location: product.php?product_id=' . $searchResult[0]['product_id']);
            exit;
        }
    } else {
        @$categories = $_POST['category'];
        if (!empty($categories)) {
            $productsByCategories = fetchAllProductsByCategory($categories);
        }
    }
}
