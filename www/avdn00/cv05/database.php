<?php
interface DatabaseOperations {
  public function create($args);
  public function fetch();
  public function update();
  public function deleteAll();
}

abstract class Database implements DatabaseOperations{
    protected $dbPath = 'db/'; 
    protected $dbExtension = '.db';
    protected $separator = ';';

    protected $data = "";

    public function __construct() {
        echo "<h2><b>Creating instance of " . static::class .  "</b></h2><br/>";
    }

    public function __toString() {
        return "<b>Database configuration: </b>" . PHP_EOL . "path: " . $this->dbPath . static::class . $this->dbExtension . "; " . 
            "separator: " . $this->separator . "<br/>";
    }

    public function filePath() {
        return $this->dbPath . static::class . $this->dbExtension;
  }

  protected function findLine( $searchedLine ){
        foreach( explode( PHP_EOL, $this->data ) as $line ){
            if( $line == $searchedLine ){
                return true;
            }
        }
        return false;
    }
}


class UsersDB extends Database {

    public function create($args) {
        file_put_contents($this->filePath(), $args['name'] . $this->separator . $args['age'] . PHP_EOL, FILE_APPEND);
        echo "User " . $args["name"] . ", age: " . $args["age"] . " has been added.<br/>";
    }

    public function fetch() {

        $data = file_get_contents( $this->dbPath . static::class . $this->dbExtension );
        $users = explode(PHP_EOL, $data);
        $usersList = [];

        if (empty($data)) {
            echo "Users fetched: Array is empty <br/>";
        } else {
            echo 'Users fetched: <br>';
            foreach ($users as $user) {
            if ($user) {
            $fields = explode(';', $user);
            $user = [
                'name' => $fields[0],
                'age' => $fields[1],
            ];
            echo "Name: " . $user['name'] . "; age: " . $user['age'] . '<br/>';
            array_push($usersList, $user);
      } } }
       return $usersList;
    }
    
    public function update() {
           echo "A user was not updated <br/>" . PHP_EOL;
  }

    public function deleteAll() {
        file_put_contents($this->filePath(), "");
        echo "All users have been removed.<br>";
        
    }
        
}

class ProductsDB extends Database {
    public function create($args) {
        file_put_contents($this->filePath(), $args['name'] . $this->separator . $args['price'] . PHP_EOL, FILE_APPEND);
        echo "Product " . $args["name"] . ", " . $args["price"] . " has been added.<br/>";
         
    }
    public function fetch() {

        $data = file_get_contents( $this->dbPath . static::class . $this->dbExtension );
        $products = explode(PHP_EOL, $data);
        $productist = [];

        if (empty($data)) {
            echo "Products fetched: Array is empty <br/>";
        } else {
            echo 'Products fetched: <br>';
            foreach ($products as $product) {
            if ($product) {
            $fields = explode(';', $product);
            $product = [
                'name' => $fields[0],
                'price' => $fields[1],
            ];
            echo "Name: " . $product['name'] . "; price: " . $product['price'] . '<br/>';
            array_push($productist, $product);
      }  
    }
        }
        
       return $productist;
       
  }


    public function update() {
        echo "A product was not updated <br/>" . PHP_EOL;
  }
    public function deleteAll() {
        file_put_contents($this->filePath(), "");
        echo "All products have been removed.<br>";
       
    }
   
}

class OrdersDB extends Database {

    public function create($args) {
        file_put_contents($this->filePath(), $args['number'] . $this->separator . $args['date'] . PHP_EOL, FILE_APPEND);
        echo "Product " . $args["number"] . ", " . $args["date"] . " has been added.<br/>";
    }
    public function fetch() {
        $data = file_get_contents( $this->dbPath . static::class . $this->dbExtension );
        $orders = explode(PHP_EOL, $data);
        $orderList = [];

        if (empty($data)) {
            echo "Orders fetched: Array is empty <br/>";
        } else {
            echo 'Orders fetched: <br>';
            foreach ($orders as $order) {
            if ($order) {
            $fields = explode(';', $order);
            $order = [
                'number' => $fields[0],
                'date' => $fields[1],
            ];
            echo "Number: " . $order['number'] . "; date: " . $order['date'] . '<br/>';
            array_push($orderList, $order);
      }  
    }
        }
        
       return $orderList;
  }

    public function update() {
         echo "An order was not updated  <br/>" . PHP_EOL;
  }
    public function deleteAll() {
        file_put_contents($this->filePath(), "");
        echo "All orders have been removed.<br>";
       
    }
    
}

$users = new UsersDB();
echo $users, PHP_EOL;
$users -> create(['name' => 'Ann', 'age' => 20]);
$users -> fetch();

$products = new ProductsDB();
echo $products, PHP_EOL;
$products -> create(['name' => 'Milk', 'price' => 60]);
$products -> create(['name' => 'Chocolate', 'price' => 45]);
$products -> fetch();

$orders = new OrdersDB();
echo $orders, PHP_EOL;
$orders -> create(['number' => 831, 'date' => '2023-03-17']);
$orders -> create(['number' => 252, 'date' => '2023-03-23']);
$orders -> fetch();
?>

