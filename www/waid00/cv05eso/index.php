<?php
require_once ("Abstract/Database.php");
require_once ("Classes/ProductsDB.php");
require_once ("Classes/OrdersDB.php");
require_once ("Classes/UsersDB.php");


$usersDB = new UsersDB();
echo $usersDB;
$usersDB->create(array("id" => 1,"name" => "John Doe", "email" => "johndoe@example.com"));
$usersDB->create(array("id" => 3,"name" => "John Doe", "email" => "johndoe@example.com"));
$usersDB->fetch(1);
$usersDB->fetch(3);
$usersDB->save(1, "asd", "asd@asd.asd");
$usersDB->fetch(1);
$usersDB->fetch(3);
$usersDB->delete(1);
$usersDB->delete(3);
echo "------------------------------------------------------------------------<br>";
$productsDB = new ProductsDB();
echo $productsDB;
$productsDB->create(array("id" => 1, "product" => "what"));
$productsDB->create(array("id" => 2, "product" => "asd"));
$productsDB->fetch(1);
$productsDB->fetch(2);
$productsDB->save(1, "idk", 'asdasd');
$productsDB->delete(1);
$productsDB->delete(2);
echo "------------------------------------------------------------------------<br>";
$ordersDB = new OrdersDB();
echo $ordersDB;
$ordersDB->create(array("id" => 1, "order" => "qweqweqwe"));
$ordersDB->create(array("id" => 2, "order" => "qghghhghgghhh"));
$ordersDB->fetch(1);
$ordersDB->fetch(2);
$ordersDB->save(1, "idk", 'qwedasqweqwe');
$ordersDB->delete(1);
$ordersDB->delete(2);
?>