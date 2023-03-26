<?php 
require ('./usersDB.php');
require ('./OrdersDB.php');
require ('./ProductsDB.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    <?php
$users = new UsersDB();
$users->create(['name' => 'Jack', 'age' => 23]);
$users->create(['name' => 'Jone', 'age' => 29]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'Magic Wand', 'price' => 888888]);
$products->create(['name' => 'Magic spell', 'price' => 9999]);
echo PHP_EOL;

$orders = new OrdersDB();
echo PHP_EOL;
echo $orders, PHP_EOL;
$orders->create(['number' => 11, 'date' => '2023-03-26']);
echo $orders, PHP_EOL;
    ?>
    </pre>
</body>
</html>