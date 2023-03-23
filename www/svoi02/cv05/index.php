<?php

interface DatabaseOperations {
    public function create($args);
    public function fetch();
    public function save($id);
    public function delete($id);
}

abstract class Database {
    protected $dbPath = './db';
    protected $dbExtension = '.db';
    protected $separator = ',';


    public function __construct()
    {
        echo 'Instance of ' . get_called_class() . ' class was created.' . PHP_EOL;
    }

    public function __toString()
    {
        return 'Db config params: ' . PHP_EOL
        . 'path: ' . $this->dbPath . PHP_EOL
        . 'file extension: ' . $this->dbExtension . PHP_EOL
        . 'file separator: ' . $this->separator . PHP_EOL;
    }
}

class UsersDB extends Database implements DatabaseOperations {
    protected $dbPath = '.users';

    public function create($args)
    {
       echo 'User ' . $args['email'] . ' with password ' . $args['password'] . ' was successfully created' . PHP_EOL; 
    }

    public function fetch()
    {
        echo 'Fetching users from file ' . $this->dbPath . $this->dbExtension . PHP_EOL;
    }
    public function save($id)
    {
        echo 'Saving changes to user with id ' . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo 'User with id ' . $id . ' was deleted' . PHP_EOL;
    }
}

class ProductsDB extends Database implements DatabaseOperations {
    protected $dbPath = '.products';
    public function create($args)
    {
        echo 'Product ' . $args['name'] . ' with a prize of ' . $args['prize'] . ' was successfully created' . PHP_EOL; 
    }

    public function fetch()
    {
        echo 'Fetching products from file ' . $this->dbPath . $this->dbExtension . PHP_EOL;
    }
    public function save($id)
    {
        echo 'Saving changes to product ' . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo 'Product with id ' . $id . ' was deleted' . PHP_EOL;
    }
}

class OrdersDB extends Database implements DatabaseOperations {
    protected $dbPath = '.orders';
    public function create($args)
    {
        echo 'Order number ' . $args['number'] . ' for ' . $args['product'] . ' was successfully created' . PHP_EOL; 
    }

    public function fetch()
    {
        echo 'Fetching orders from file ' . $this->dbPath . $this->dbExtension . PHP_EOL;
    }
    public function save($id)
    {
        echo 'Saving changes to order number ' . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo 'Order number ' . $id . ' was deleted' . PHP_EOL;
    }
}


$user = new UsersDB();
echo $user;
$user->fetch();
echo PHP_EOL;
$user->save(42);
echo PHP_EOL;
$user->delete(42);
echo PHP_EOL;

$product = new ProductsDB();
$product->create(['name' => 'excalibur', 'prize' => '420']);
$product->fetch();
$order = new OrdersDB();
$order->delete(54);



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
    <h1>DU5</h1>
</body>
</html>