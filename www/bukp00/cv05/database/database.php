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
  protected $dbPath = 'db-store/';
  protected $dbExtension = '.db';
  protected $separator = ';';
  public function __construct()
  {
    echo '<b>Database class ', static::class, ' was initialized.</b>', PHP_EOL;
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
    $usersData = file_get_contents($this->filePath());
    // Split string by user rows
    $users = explode(PHP_EOL, $usersData);

    $usersList = [];

    foreach ($users as $user) {
      if ($user) {
        $fields = explode(';', $user);

        // Create associative array
        $user = [
          'name' => $fields[0],
          'age' => $fields[1],
        ];

        array_push($usersList, $user);
      }
    }

    echo 'A user was fetched - total: ' . count($usersList), PHP_EOL;
    return $usersList;
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
    $productsData = file_get_contents($this->filePath());
    // Split string by product rows
    $products = explode(PHP_EOL, $productsData);

    $productsList = [];

    foreach ($products as $product) {
      if ($product) {
        $fields = explode(';', $product);

        // Create associative array
        $product = [
          'name' => $fields[0],
          'price' => $fields[1],
        ];

        array_push($productsList, $product);
      }
    }

    echo 'A product was fetched - total: ' . count($productsList), PHP_EOL;
    return $productsList;
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
    $ordersData = file_get_contents($this->filePath());
    // Split string by orders rows
    $orders = explode(PHP_EOL, $ordersData);

    $ordersList = [];

    foreach ($orders as $order) {
      if ($order) {
        $fields = explode(';', $order);

        // Create associative array
        $order = [
          'number' => $fields[0],
        ];

        array_push($ordersList, $order);
      }
    }

    echo 'An order was fetched - total: ' - count($ordersList), PHP_EOL;
    return $ordersList;
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
$users->create(['name' => 'Dave', 'age' => 42]);
$users->create(['name' => 'Maria', 'age' => 22]);
$users->fetch();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
echo $products, PHP_EOL;
$products->create(['name' => 'Mary', 'price' => 4500]);
$products->create(['name' => 'Harry', 'price' => 7690]);
echo PHP_EOL;

$orders = new OrdersDB();
echo $orders, PHP_EOL;
$orders->create(['number' => 42]);
echo PHP_EOL;
