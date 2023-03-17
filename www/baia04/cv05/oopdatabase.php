<?php 
$title = "OOPDatabase";
require('./src/header.php');
require('./Database.php');
require('./StringBuilder.php');
$stringBuilder = new StringBuilder;

?> <pre> <?php
class UsersDB extends Database {
    public function create($args) { 
        return 'User ' . $args['name'] . ' age: ' . $args['age'] . ' was created'. PHP_EOL; 
    }
    public function fetch()  { return 'A user was fetched' . PHP_EOL; }
    public function save()   { return 'A user was saved  ' . PHP_EOL; }
    public function delete() { return 'A user was deleted' . PHP_EOL; }
}
class ProductsDB extends Database {
    public function create($args) { 
        return 'Product ' . $args['name'] . ' $' . $args['price'] . ' was created' . PHP_EOL; 
    }
    public function fetch()  { return 'A product was fetched' . PHP_EOL; }
    public function save()   { return 'A product was saved  ' . PHP_EOL; }
    public function delete() { return 'A product was deleted' . PHP_EOL; }
}
class OrdersDB extends Database {
    public function create($args) { 
        return 'Order no. ' . $args['number'] . ' was created' . PHP_EOL; 
    }
    public function fetch()  { return 'An order was fetched' . PHP_EOL; }
    public function save()   { return 'An order was saved  ' . PHP_EOL; }
    public function delete() { return 'An order was deleted' . PHP_EOL; }
}

$users = new UsersDB();
$stringBuilder -> append(
    $users -> constructorInfo() .
    $users -> create(['name' => 'Jack', 'age' => 24]) .
    $users -> create(['name' => 'John', 'age' => 32]) .
    $users -> fetch() .
    $users -> save() .
    $users -> delete() .
    PHP_EOL
);

$products = new ProductsDB();
$stringBuilder -> append(
    $products -> constructorInfo() .
    $products -> create(['name' => 'Bar of chocolate', 'price' => 35]) .
    $products -> create(['name' => 'Loaf of bread', 'price' => 20]) .
    PHP_EOL
);

$orders = new OrdersDB();
$stringBuilder -> append(
    $orders -> constructorInfo() .
    $orders -> configInfo() .
    PHP_EOL .
    $orders . PHP_EOL .
    $orders -> create(['number' => 8, 'date' => '2023-03-17']) .
    $orders . PHP_EOL
);

$text = $stringBuilder -> build();
require('./src/technique.php');
?> </pre>