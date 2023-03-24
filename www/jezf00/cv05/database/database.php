<?php
interface DatabaseOperations
{
  public function fetch();
  public function create($args);
  public function save($args);
  public function delete();
}

abstract class Database implements DatabaseOperations
{
  protected $dbPath = 'db-storage/';
  protected $dbExtension = '.db';
  protected $separator = ';';
  public function __construct()
  {
    echo '<h2>Database class ', static::class, ' was initialized.</h2>', PHP_EOL;
  }
  public function __toString()
  {
    return "DB: $this->dbPath" . static::class . $this->dbExtension . $this->separator;
  }
  public function filePath()
  {
    return $this->dbPath . static::class . $this->dbExtension;
  }
  public function getSeparator()
  {
    return $this->separator;
  }
}

class UsersDB extends Database
{
  public function create($args)
  {
    $this->save($args);
    echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL;
  }

  public function fetch()
  {
    echo 'A user was fetched', PHP_EOL;
  }

  public function save($args)
  {
    file_put_contents($this->filePath(), $args['name'] . $this->getSeparator() . $args['age'] . PHP_EOL, FILE_APPEND);
    echo 'A user was saved  ', PHP_EOL;
  }

  public function delete()
  {
    echo 'A user cannot be deleted', PHP_EOL;
  }
}

class ProductsDB extends Database
{
  public function create($args)
  {
    $this->save($args);
    echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL;
  }

  public function fetch()
  {
    echo 'A product was fetched', PHP_EOL;
  }

  public function save($args)
  {
    file_put_contents($this->filePath(), $args['name'] . $this->getSeparator() . $args['price'] . PHP_EOL, FILE_APPEND);
    echo 'A product was saved  ', PHP_EOL;
  }

  public function delete()
  {
    echo 'A product cannot be deleted', PHP_EOL;
  }
}

class OrdersDB extends Database
{
  public function create($args)
  {
    echo 'Order no. ', $args['number'], ' was created', PHP_EOL;
    $this->save($args);
  }

  public function fetch()
  {
    echo 'An order was fetched', PHP_EOL;
  }

  public function save($args)
  {
    file_put_contents($this->filePath(), $args['number'] . PHP_EOL, FILE_APPEND);
    echo 'An order was saved  ', PHP_EOL;
  }

  public function delete()
  {
    echo 'An order cannot be deleted', PHP_EOL;
  }
}

$users = new UsersDB();
echo $users, PHP_EOL;
$users->create(['name' => 'Filip', 'age' => 21]);
$users->create(['name' => 'David', 'age' => 22]);
$users->fetch();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
echo $products, PHP_EOL;
$products->create(['name' => 'Table', 'price' => 89]);
$products->create(['name' => 'Chair', 'price' => 64]);
$products->fetch();
echo PHP_EOL;

$orders = new OrdersDB();
echo $orders, PHP_EOL;
$orders->create(['number' => 15]);
$orders->fetch();
echo PHP_EOL;