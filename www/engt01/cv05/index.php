<?php
require "OrdersDB.php";
require "ProductsDB.php";
require "UsersDB.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<pre>
<?php
$users = new UsersDB();
$users->create(['name' => 'Kimi', 'age' => 35]);
$users->create(['name' => 'Mark', 'age' => 45]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'Gloves', 'price' => 1000]);
$products->create(['name' => 'Steering Wheel', 'price' => 50000]);
echo PHP_EOL;

$orders = new OrdersDB();
echo PHP_EOL;
echo $orders, PHP_EOL;
$orders->create(['number' => 7, 'date' => '2017-06-25']);
echo $orders, PHP_EOL;
?>
</pre>
</body>
</html>
