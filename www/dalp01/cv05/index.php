<?php
interface DBOperations{
    function create( $args );
    function fetch();
    function save();
    function delete();
    function deleteOne( $args );
}

abstract class Database implements DBOperations{
    // public is a bad habit and private wouldn't work in derived classes -> protected
    protected $dbPath = "./db/";
    protected $fileExtension = ".db";
    protected $separator = ";";

    protected $data = "";

    public function __construct(){ echo "Database " . static::class . " has been initiated.<br/>"; }
    public function __toString(){ return "Database config: db_path(\"$this->dbPath\"), file_extension(\"$this->fileExtension\"), separator(\"$this->separator\")<br/>"; }

    public function setDB_Path( $dbPath ){ $this->dbPath = $dbPath; }
    public function setFileExtension( $fileExtension ){ $this->fileExtension = $fileExtension; }
    public function setSeparator( $separator ){ $this->separator = $separator; }

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
    private $fileName = "users";

    public function create($args){
        $line = $args["name"].$this->separator.$args["age"];

        if( ! Database::findLine( $line ) ){
            $this->data = ( $this->data . $line . PHP_EOL );
            echo "User " . $args["name"] . ", " . $args["age"] . " has been added.<br/>";
        } else {
            echo "User " . $args["name"] . ", " . $args["age"] . " is already in the database.<br/>";
        }
    }

    public function fetch(){
        $this->data = file_get_contents( $this->dbPath . $this->fileName . $this->fileExtension );
        echo "Temporary database data of " . static::class . " have been loaded from file.<br/>";
    }

    public function save(){
        file_put_contents( $this->dbPath . $this->fileName . $this->fileExtension, $this->data );
        echo "Temporary database data of " . static::class . " have been saved into file.<br/>";
    }

    public function delete(){
        $this->data = "";
        echo "Temporary database data of " . static::class . " have been deleted. SAVE to delete file data.<br/>";
    }

    public function deleteOne( $args ){
        $tmpData = "";
        $searchedLine = $args["name"].$this->separator.$args["age"];
        foreach( explode( PHP_EOL, $this->data ) as $line ){
            if( $line != $searchedLine ){
                $tmpData = ( $tmpData . $line . PHP_EOL );
            } else {
                echo "Selected User has been deleted.<br/>";
            }
        }

        if( strcmp( $this->data, $tmpData ) != 0 ){
            $this->data = $tmpData;
        } else {
            echo "Error: Selected User has not been found.<br/>";
        }
    }
}

class ProductsDB extends Database {
    private $fileName = "products";

    public function create($args){
        $line = $args["name"].$this->separator.$args["price"];

        if( ! Database::findLine( $line ) ){
            $this->data = ( $this->data . $line . PHP_EOL );
            echo "Product " . $args["name"] . ", " . $args["price"] . " has been added.<br/>";
        } else {
            echo "Product " . $args["name"] . ", " . $args["price"] . " is already in the database.<br/>";
        }
    }

    public function fetch(){
        $this->data = file_get_contents( $this->dbPath . $this->fileName . $this->fileExtension );
        echo "Temporary database data of " . static::class . " have been loaded from file.<br/>";
    }

    public function save(){
        file_put_contents( $this->dbPath . $this->fileName . $this->fileExtension, $this->data );
        echo "Temporary database data of " . static::class . " have been saved into file.<br/>";
    }

    public function delete(){
        $this->data = "";
        echo "Temporary database data of " . static::class . " have been deleted. SAVE to delete file data.<br/>";
    }

    public function deleteOne( $args ){
        $tmpData = "";
        $searchedLine = $args["name"].$this->separator.$args["price"];
        foreach( explode( PHP_EOL, $this->data ) as $line ){
            if( $line != $searchedLine ){
                $tmpData = ( $tmpData . $line . PHP_EOL );
            } else {
                echo "Selected Product has been deleted.<br/>";
            }
        }
        
        if( strcmp( $this->data, $tmpData ) != 0 ){
            $this->data = $tmpData;
        } else {
            echo "Error: Selected Product has not been found.<br/>";
        }
    }
}

class OrdersDB extends Database {
    private $fileName = "orders";

    public function create($args){
        $line = $args["number"].$this->separator.$args["date"];

        if( ! Database::findLine( $line ) ){
            $this->data = ( $this->data . $line . PHP_EOL );
            echo "Order " . $args["number"] . ", " . $args["date"] . " has been added.<br/>";
        } else {
            echo "Order " . $args["number"] . ", " . $args["date"] . " is already in the database.<br/>";
        }
    }

    public function fetch(){
        $this->data = file_get_contents( $this->dbPath . $this->fileName . $this->fileExtension );
        echo "Temporary database data of " . static::class . " have been loaded from file.<br/>";
    }

    public function save(){
        file_put_contents( $this->dbPath . $this->fileName . $this->fileExtension, $this->data );
        echo "Temporary database data of " . static::class . " have been saved into file.<br/>";
    }

    public function delete(){
        $this->data = "";
        echo "Temporary database data of " . static::class . " have been deleted. SAVE to delete file data.<br/>";
    }

    public function deleteOne( $args ){
        $tmpData = "";
        $searchedLine = $args["number"].$this->separator.$args["date"];
        foreach( explode( PHP_EOL, $this->data ) as $line ){
            if( $line != $searchedLine ){
                $tmpData = ( $tmpData . $line . PHP_EOL );
            } else {
                echo "Selected Order has been deleted.<br/>";
            }
        }
        
        if( strcmp( $this->data, $tmpData ) != 0 ){
            $this->data = $tmpData;
        } else {
            echo "Error: Selected Order has not been found.<br/>";
        }
    }
}

$users = new UsersDB();
$users->fetch();
$users->create(["name" => "Monke", "age" => 10]);
$users->create(["name" => "Monke", "age" => 10]);
$users->deleteOne(["name" => "Monke", "age" => 10]);
$users->create(["name" => "Monke", "age" => 10]);
$users->delete();
$users->save();


$products = new ProductsDB();
$products->fetch();
$products->create(["name" => "Gold chunk", "price" => 1000]);
$products->save();
$products->delete();
$products->save();

$orders = new OrdersDB();
echo $orders;
$orders->create(["number" => 681665, "date" => "2023-03-23"]);
$orders->save();
?>