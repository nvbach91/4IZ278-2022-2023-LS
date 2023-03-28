<?php

require_once './classes/UsersDB.php';
require_once './classes/ProductsDB.php';
require_once './classes/OrdersDB.php';

echo '<pre>';

$users = new UsersDB();
$users->create(['name' => 'Dave', 'age' => 42]);
$users->create(['name' => 'Bob', 'age' => 24]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'Broom of Harry', 'price' => 4500]);
$products->create(['name' => 'Wand of Albuss', 'price' => 7690]);
echo PHP_EOL;

$orders = new OrdersDB();
$orders->configInfo();
echo PHP_EOL;
echo $orders, PHP_EOL;
$orders->create(['number' => 42, 'date' => '2019-03-08']);
echo $orders, PHP_EOL;

echo '</pre>';