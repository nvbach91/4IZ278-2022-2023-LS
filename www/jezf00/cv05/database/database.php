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

require './database/UsersDB.php'; 
require './database/ProductsDB.php';
require  './databese/OrdersDB.php';


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
?>