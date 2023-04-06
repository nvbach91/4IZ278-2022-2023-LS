<?php include("./includes/header.php") ?>

<?php require("./database.php") ?>

<?php

require("./UsersDB.php");

require("./ProductsDB.php");

require("./OrdersDB.php");








$usersDB = new UsersDB;
$usersDB->create(['name' => 'Patrik Šmátrala', 'email' => 'smap01@vse.cz']);
$users = $usersDB->fetch();
foreach ($users as $user) {
    echo "<br>$user[0] has an email address $user[1]</br>" . PHP_EOL;
}
$productsDB = new ProductsDB;
$productsDB->create(['name' => 'Table', 'price' => '2000 Kč']);
$products = $productsDB->fetch();
foreach ($products as $product) {
    echo "<br>$product[0] has a price of $product[1]</br>" . PHP_EOL;
}
$ordersDB = new OrdersDB;
$ordersDB->create(['name' => 'Food', 'priority' => '1']);
$orders = $ordersDB->fetch();
foreach ($orders as $order) {
    echo "<br>$order[0] has a priority of $order[1]</br>" . PHP_EOL;
}
?>

<?php include("./includes/footer.php") ?>