<?php
include 'DatabaseOperations.php';
include 'OrdersDB.php';
include 'ProductsDB.php';
include 'UsersDB.php';


$orders = new OrdersDB();
$orders->configInfo();
echo PHP_EOL;
echo $orders, PHP_EOL;
$orders->create(['number' => 92, 'date' => '2019-03-08']);
echo $orders, PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'Broom of Harry', 'price' => 4500]);
$products->create(['name' => 'Wand of Albuss', 'price' => 7690]);
echo PHP_EOL;

$users->create(['name' => 'Tom', 'age' => 92]);
$users->create(['name' => 'Tom', 'age' => 92]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;





?>