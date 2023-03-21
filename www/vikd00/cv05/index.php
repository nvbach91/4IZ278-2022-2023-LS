<?php require './ordersDb.php'; ?>
<?php require './productsDb.php'; ?>
<?php require './usersDb.php'; ?>
<?php require_once './database.php'; ?>
<?php

$usersDB = new UsersDB();
echo "<br>";
echo $usersDB;
echo "<br>";
$usersDB->create(array('name' => 'Andrew', 'email' => 'andrew@gmail.com'));
echo "<br>";
$usersDB->save(1, array('name' => 'Andy', 'email' => 'andrew@gmail.com'));
echo "<br>";
$usersDB->fetch(1);
echo "<br>";
$usersDB->delete(1);
echo "<br><br>";

$productsDB = new ProductsDB();
echo "<br>";
echo $productsDB;
echo "<br>";
$productsDB->create(array('name' => 'car', 'weight' => '1200'));
echo "<br>";
$productsDB->create(array('name' => 'truck', 'weight' => '2200'));
echo "<br>";
$productsDB->save(1, array('name' => 'car', 'weight' => '1500'));
echo "<br>";
$productsDB->fetch(1);
echo "<br>";
$productsDB->delete(1);
echo "<br><br>";

$ordersDB = new OrdersDB();
echo "<br>";
echo $ordersDB;
echo "<br>";
$ordersDB->create(array('userId' => 1, 'productId' => 1));
echo "<br>";
$ordersDB->save(1, array('userId' => 1, 'productId' => 2));
echo "<br>";
$ordersDB->fetch(1);
echo "<br>";
$ordersDB->delete(1);
echo "<br><br>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB</title>
</head>

<body>
    <p>Database interface in PHP</p>
</body>

</html>