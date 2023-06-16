<?php
require './CartDatabase.php';
session_start();
//require './ProductsDatabase.php';
$errors = [];
if (!empty($_POST)) {
    $myArray = $_POST['my_array'];
    $user_id = $_POST['user_id'];
    $myArray_quantity = $_POST['my_array_quantity'];
    $array = array_combine($myArray, $myArray_quantity);
    $cartDatabase = new CartDatabase();
    //$productsDatabase = new ProductsDatabase();

    foreach ($array as $key => $value) {
        $result = $cartDatabase->addToCart($key, $user_id, $value);
        if (!$result) {
            array_push($errors, "Something went wrong.");
        }
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
    }
    /*foreach ($array as $key => $value) {
        $products = $productsDatabase->fetchByProductId($key);
        foreach($products as $product){
            $quantity = $product['q_in_stock']-$value;       ...........change g_in_stock?
        }

    }*/
    if (empty($errors)) {
        header('Location: successfuly_bought.php');
    }
}
