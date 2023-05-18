<?php
require('./header.php');
require('./db/Database.php');
$db = new Database();

$stmt = $db->pdo->prepare("SELECT * FROM `cv06_categories`");
$stmt -> execute();
$categories = $stmt -> fetchAll();
require('./categories.php');

if (isset($_GET['category_id'])) {
    $sql = "SELECT * FROM cv06_products WHERE `category_id` = :id";
    $stmt = $db->pdo->prepare($sql);
    $stmt->execute(['id' => $_GET['category_id']]);
    $goods = $stmt -> fetchAll();
} else {
    $stmt = $db->pdo->prepare("SELECT * FROM `cv06_products`");
    $stmt -> execute();
    $goods = $stmt -> fetchAll();
}

$withDiscount = [];
$stmt = $db->pdo->prepare("SELECT * FROM `cv06_products`");
$stmt -> execute();
$allGoods = $stmt -> fetchAll();
foreach ($allGoods as $good) {
    if ($good['discount'] > 0) {
        array_push($withDiscount, $good);
    }
} 

$nItemsPerPagination = 4;
if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}
# celkovy pocet zbozi pro strankovani
$count = $db->pdo->query("SELECT COUNT(product_id) FROM cv06_products")->fetchColumn();

$stmt = $db->pdo->prepare("SELECT * FROM cv06_products ORDER BY `product_id` DESC LIMIT $nItemsPerPagination OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll();
require('./slider.php');
require('./cards.php');
require('./footer.php');
?>