<?php

require_once './classes/OrdersDB.php';
require_once './classes/ProductsDB.php';
require_once './classes/UsersDB.php';

echo '<pre>';

$users = new UsersDB();
$users->create(['name' => 'Matěj', 'age' => 21]);
$users->create(['name' => 'Adam', 'age' => 22]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'Carrot', 'price' => 100]);
$products->create(['name' => 'Apple', 'price' => 200]);
echo PHP_EOL;

$orders = new OrdersDB();
$orders->configInfo();
echo PHP_EOL;
echo $orders, PHP_EOL;
$orders->create(['number' => 42, 'date' => '2023-04-28']);
$orders->create(['number' => 43, 'date' => '2023-04-28']);
echo $orders, PHP_EOL;

echo '</pre>';

?>