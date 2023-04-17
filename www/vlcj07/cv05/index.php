<?php

include './classes/Database.php';
include './classes/OrdersDB.php';
include './classes/ProductsDB.php';
include './classes/UsersDB.php';

include './header.php';
?>

<h1>database</h1>
<?php
$users = new UsersDB();
$users->create(['id' => 1,'name' => 'Joe', 'age' => 21]);
$users->fetch(1);
$users->create(['id' => 2,'name' => 'Otto', 'age' => 12]);
$users->save(2, array('name' => 'Mitch', 'age' => 50));
$users->create(['id' => 3,'name' => 'Mike', 'age' => 12]);
$users->delete(3, array('name' => 'Mike'));
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'Lamborghini Huracán', 'price' => 5714000]);
$products->create(['name' => 'Lego Technic Ferrari Daytona SP3', 'price' => 9159]);
$products->create(['name' => 'Opel Agila 1.0', 'price' => 16500]);
echo PHP_EOL;

$orders = new OrdersDB();
$orders->create(['number' => 1, 'date' => '2021-05-20']);
echo PHP_EOL;

$orders->create(['number' => 1, 'date' => '2021-05-20']);
$orders->create(['number' => 2, 'date' => '2021-05-21']);
$orders->fetch(2);
echo $orders, PHP_EOL;
$orders->save(1, array('date' => '2021-05-20'));
echo $orders, PHP_EOL;
$orders->create(['number' => 2, 'date' => '2021-05-22']);

?>

<?php include './footer.php'; ?>
    

