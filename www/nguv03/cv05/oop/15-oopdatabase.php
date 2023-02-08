<?php

interface DatabaseOperations {
    // note that these methods have no body
    // where are their bodies?
    public function fetch();
    public function create($args);
    public function save();
    public function delete();
}
abstract class Database implements DatabaseOperations {
    // why is protected used here?
    protected $dbPath = '/app/db/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    public function __construct() {
        // what is static::class?
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }
    // this will get returned when one tries to stringify the instance with i.e. echo
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
        echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL; 
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body { display: flex; }
        pre { padding: 10px; width: 50%; overflow-x: auto; }
    </style>
</head>
<body>
    <pre class="prettyprint lang-php">

    interface DatabaseOperations {
    // note that these methods have no body
    // where are their bodies?
    public function fetch();
    public function create($args);
    public function save();
    public function delete();
}
abstract class Database implements DatabaseOperations {
    // why is protected used here?
    protected $dbPath = '/app/db/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    public function __construct() {
        // what is static::class?
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }
    // this will get returned when one tries to stringify the instance with i.e. echo
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
        echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL; 
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
$users->create(['name' => 'Dave', 'age' => 42]);
$users->create(['name' => 'Dave', 'age' => 42]);
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


    </pre>
    <pre><?php 
            
            $users = new UsersDB();
            $users->create(['name' => 'Dave', 'age' => 42]);
            $users->create(['name' => 'Jane', 'age' => 29]);
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

    ?></pre>
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
</body>
</html>