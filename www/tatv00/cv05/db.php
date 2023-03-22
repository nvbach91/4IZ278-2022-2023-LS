<?php
interface DatabaseOperations {
    public function create($id, $data);
    public function fetch($id);
    public function save($id, $data);
    public function delete($id);
}

abstract class Database implements DatabaseOperations {
    protected $databaseFolderPath; // database folder path
    protected $databaseFileExtension; // extension of database files
    protected $fieldDelimiter; // field delimiter in database file

    public function __construct(
        $databaseFolderPath = "./database/",
        $databaseFileExtension = ".db",
        $fieldDelimiter = ";"
    ) {
        $this->databaseFolderPath = $databaseFolderPath;
        $this->databaseFileExtension = $databaseFileExtension;
        $this->fieldDelimiter = $fieldDelimiter;

        echo "Object was created - " . get_class($this) . "\n";
    }

    public function __toString() {
        return "Path to DB folder: {$this->databaseFolderPath}\n"
            . "Extension of database files: {$this->databaseFileExtension}\n"
            . "Field delimiter in database file: {$this->fieldDelimiter}\n";
    }
}

class UsersDB extends Database {
    public function create($id, $data) {
        $build_string = "";
        // echo "User was created with data: " . $data['name'] . " ". $data['age'] . "\n";
        echo "User was created with data: " . json_encode($data) . "\n";
    }

    public function fetch($id) {

        echo "User with ID {$id} has been fetched\n";
    }

    public function save($id, $data) {

        echo "User with ID {$id} has been saved: " . json_encode($data) . "\n";
    }

    public function delete($id) {

        echo "User with ID {$id} has been deleted\n";
    }
}

class ProductsDB extends Database {
    public function create($id, $data) {

        echo "Product was created with data: " . json_encode($data) . "\n";
    }

    public function fetch($id) {

        echo "Product with ID {$id} fetched\n";
    }

    public function save($id, $data) {

        echo "Product with ID {$id} has been saved: " . json_encode($data) . "\n";
    }

    public function delete($id) {

        echo "Product with ID {$id} has been deleted \n";
    }
}

class OrdersDB extends Database {
    public function create($id, $data) {

        echo "Order was created with data: " . json_encode($data) . "\n";
    }

    public function fetch($id) {

        echo "Order with ID {$id} has been fetched\n";
    }

    public function save($id, $data) {
        echo "Order with ID {$id} has been saved: " . json_encode($data) . "\n";
    }

    public function delete($id) {

        echo "Order with ID {$id} has been deleted\n";
    }


}

$users = new UsersDB();
echo $users, PHP_EOL;
$users->create(1, ["id"=> 1, "name" => "John", "age" => 25]);

$products = new ProductsDB();
echo $products, PHP_EOL;
$products->create(2, ["id"=> 2, "name" => "Apple", "price" => 10]);

$orders = new OrdersDB();
echo $orders, PHP_EOL;
$orders->create(1, ["id"=> 1, "user_id" => 1, "product_id" => 2, "quantity" => 3]);

$users->fetch(1);
?>