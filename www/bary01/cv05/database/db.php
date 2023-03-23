<?php
interface DatabaseOperations {
    public function fetch();
    public function create($args);
    public function save();
    public function delete();
}
abstract class Database implements DatabaseOperations {
    protected $dbPath = './database/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    public function __construct() {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }
    public function __toString() {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }
    public function configInfo() { 
        echo $this;
    }
}
class UsersDB extends Database {
    public function create($args) { 
        echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL; 
    }
    public function fetch()  { echo 'A user was fetched', PHP_EOL; }
    public function save()   { echo 'A user was saved  ', PHP_EOL; }
    public function delete() { echo 'A user was deleted', PHP_EOL; }
}
class ProductsDB extends Database {
    public function create($args) { 
        echo 'Product ', $args['name'], ' CZK', $args['price'], ' was created', PHP_EOL; 
    }
    public function fetch()  { echo 'A product was fetched', PHP_EOL; }
    public function save()   { echo 'A product was saved  ', PHP_EOL; }
    public function delete() { echo 'A product was deleted', PHP_EOL; }
}
class OrdersDB extends Database {
    public function create($args) { 
        echo 'Order no. ', $args['number'], ' was created', PHP_EOL; 
    }
    public function fetch()  { echo 'An order was fetched', PHP_EOL; }
    public function save()   { echo 'An order was saved  ', PHP_EOL; }
    public function delete() { echo 'An order was deleted', PHP_EOL; }
}


$users = new UsersDB();
$users->create(['name' => 'Yana', 'age' => 19]);
$users->create(['name' => 'Maks', 'age' => 30]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'MacBook', 'price' => 63900]);
$products->create(['name' => 'Iphone', 'price' => 34900]);
$products->create(['name' => 'AirPods', 'price' => 10900]);
echo PHP_EOL;

$orders = new OrdersDB();
$orders->configInfo();
echo PHP_EOL;
echo $orders, PHP_EOL;
$orders->create(['number' => 3, 'date' => '2023-03-08']);
echo $orders, PHP_EOL;
?>