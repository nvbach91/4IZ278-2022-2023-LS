<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/Admin.php';
require_once 'classes/Product.php';
require_once 'classes/Order.php';


$db = new Database();
$productObj = new Product($db);
$orderObj = new Order($db);
$adminObj = new Admin($orderObj, $productObj);

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$q_in_stock = $_POST['q_in_stock'];
$category_id = $_POST['category_id'];

try {

    $adminObj->updateProduct($product_id, $name, $price, $description, $q_in_stock, $category_id, $_FILES['photo']);
    echo "Aktualizovanie prebehlo v poriadku.";
} catch (Exception $e) {
    echo "Vyskytla sa chyba pri aktualizovaní produktu.";
    echo 'Here is some more debugging info: ' . $e->getMessage();
}

header('Location: admin.php');
?>