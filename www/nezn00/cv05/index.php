<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>  Database Operations </h1>
    <style> 
           body{
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            text-align: left;
            margin-left: 700px;

        }
        
</style>

<?php
interface DBOperations{
    function create( $args );
    function fetch();
    function save();
    function delete();
    function deleteOne( $args );
}

abstract class Database implements DBOperations{
    
    public $dbPath = "./database/";
    public $fileExtension = ".db";
    public $separator = ";";
    public $data = "";

    
    
    public function __construct(){ echo "Database " . static::class . " has been initiated.<br/>"; }
    public function __toString(){ return "Database config: db_path(\"$this->dbPath\"), file_extension(\"$this->fileExtension\"), separator(\"$this->separator\")<br/>"; }



    public function setDB_Path( $dbPath ){ $this->dbPath = $dbPath; }
    public function setFileExtension( $fileExtension ){ $this->fileExtension = $fileExtension; }
    public function setSeparator( $separator ){ $this->separator = $separator; }
    public function findLine( $searchedLine ){
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
            echo "User " . $args["name"] . ", " . $args["age"] . " has been added to the database.<br/>";
        } else {
            echo "User " . $args["name"] . ", " . $args["age"] . " is already inside the database.<br/>";
        }
    }

    public function fetch(){
        $this->data = file_get_contents( $this->dbPath . $this->fileName . $this->fileExtension );
        echo "Database data of " . static::class . " have been loaded from file.<br/>";
    }

    public function save(){
        file_put_contents( $this->dbPath . $this->fileName . $this->fileExtension, $this->data );
        echo "Database data of " . static::class . " have been saved into file.<br/>";
    }

    public function delete(){
        $this->data = "";
        echo "Database data of " . static::class . " have been deleted.<br/>";
    }

    public function deleteOne( $args ){
        $tmpData = "";
        $searchedLine = $args["name"].$this->separator.$args["age"];
        foreach( explode( PHP_EOL, $this->data ) as $line ){
            if( $line != $searchedLine ){
                $tmpData = ( $tmpData . $line . PHP_EOL );
            } else {
                echo "User has been deleted.<br/>";
            }
        }

        if( strcmp( $this->data, $tmpData ) != 0 ){
            $this->data = $tmpData;
        } else {
            echo "Error: User has not been found.<br/>";
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
        echo "Database data of " . static::class . " have been loaded from file.<br/>";
    }

    public function save(){
        file_put_contents( $this->dbPath . $this->fileName . $this->fileExtension, $this->data );
        echo "Database data of " . static::class . " have been saved into file.<br/>";
    }

    public function delete(){
        $this->data = "";
        echo "Database data of " . static::class . " have been deleted.<br/>";
    }

    public function deleteOne( $args ){
        $tmpData = "";
        $searchedLine = $args["name"].$this->separator.$args["price"];
        foreach( explode( PHP_EOL, $this->data ) as $line ){
            if( $line != $searchedLine ){
                $tmpData = ( $tmpData . $line . PHP_EOL );
            } else {
                echo "Product has been deleted.<br/>";
            }
        }

        if( strcmp( $this->data, $tmpData ) != 0 ){
            $this->data = $tmpData;
        } else {
            echo "Error: Product has not been found.<br/>";
        }
    }
}

class OrdersDB extends Database {
    private $fileName = "orders";

    public function create($args){
        $line = $args["number"].$this->separator.$args["date"];

        if( ! Database::findLine( $line ) ){
            $this->data = ( $this->data . $line . PHP_EOL );
            echo "Order " . $args["number"] . ", " . $args["date"] . " has been added to the database.<br/>";
        } else {
            echo "Order " . $args["number"] . ", " . $args["date"] . " is already in the database.<br/>";
        }
    }

    public function fetch(){
        $this->data = file_get_contents( $this->dbPath . $this->fileName . $this->fileExtension );
        echo "Database data of " . static::class . " have been loaded from file.<br/>";
    }

    public function save(){
        file_put_contents( $this->dbPath . $this->fileName . $this->fileExtension, $this->data );
        echo "Database data of " . static::class . " have been saved into file.<br/>";
    }

    public function delete(){
        $this->data = "";
        echo "Database data of " . static::class . " have been deleted.<br/>";
    }

    public function deleteOne( $args ){
        $tmpData = "";
        $searchedLine = $args["number"].$this->separator.$args["date"];
        foreach( explode( PHP_EOL, $this->data ) as $line ){
            if( $line != $searchedLine ){
                $tmpData = ( $tmpData . $line . PHP_EOL );
            } else {
                echo "Order has been deleted.<br/>";
            }
        }

        if( strcmp( $this->data, $tmpData ) != 0 ){
            $this->data = $tmpData;
        } else {
            echo "Error: Order number has not been found.<br/>";
        }
    }
}


$users = new UsersDB();
$users->fetch();
$users->create(["name" => "luffy", "age" => 21]);
$users->create(["name" => "luffy", "age" => 21]);
$users->deleteOne(["name" => "luffy", "age" => 21]);
$users->create(["name" => "luffy", "age" => 21]);
$users->delete();
$users->save();







$products = new ProductsDB();
$products->fetch();
$products->create(["name" => "one piece", "price" => 100000]);
$products->save();
$products->delete();
$products->save();


$orders = new OrdersDB();
echo $orders;
$orders->create(["number" => 777111, "date" => "2023-03-23"]);
$orders->save();




?>

</body>
</html>