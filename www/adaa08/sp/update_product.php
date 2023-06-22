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
require_once 'classes/User.php';

$db = new Database();
$productObj = new Product($db);
$orderObj = new Order($db);
$userObj = new User($db);
$adminObj = new Admin($orderObj, $productObj, $userObj);

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$q_in_stock = $_POST['q_in_stock'];
$category_id = $_POST['category_id'];
$photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;

try {
    $adminObj->updateProduct($product_id, $name, $price, $description, $q_in_stock, $category_id, $photo);
    echo "Aktualizovanie prebehlo v poriadku.";
} catch (Exception $e) {
    echo "Vyskytla sa chyba pri aktualizovaní produktu.";
    echo 'Here is some more debugging info: ' . $e->getMessage();
}

header('Location: admin.php');
?>