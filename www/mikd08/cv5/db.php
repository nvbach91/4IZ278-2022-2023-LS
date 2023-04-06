<?php

interface DatabaseOperations {
    public function create($args);
    public function fetch();
    public function save();
    public function delete();
}

abstract class Database1 implements DatabaseOperations {
    protected $dbPath = '/db'; 
    protected $dbExtension = '.db';
    protected $seperator = ';';

    public function __construct() {
        echo PHP_EOL."-------- ".static::class." was created--------".PHP_EOL;
    }

    public function __toString() {
        return "dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, seperator: \"$this->seperator\"".PHP_EOL;
    }

}

class UsersDB extends Database1 {
    public function create($args){
        echo "User $args[name] age: $args[age] was created".PHP_EOL; 
    }
    public function fetch(){
        echo 'A user was fetched'.PHP_EOL;
    }
    public function save(){
        echo 'A user was saved'.PHP_EOL;
    }
    public function delete(){
        echo 'A user was deleted'.PHP_EOL;
    }
}
class ProductsDB extends Database1 {
    public function create($args){
        echo "Product $args[name] price: $args[price] was created".PHP_EOL;
    }
    public function fetch(){
        echo 'A product was fetched'.PHP_EOL;
    }
    public function save(){
        echo 'A product was saved'.PHP_EOL;
    }
    public function delete(){
        echo 'A product was deleted'.PHP_EOL;
    }
}
class OrdersDB extends Database1 {
    public function create($args){
        echo "Order $args[number] was created".PHP_EOL;
    }
    public function fetch(){
        echo 'A order was fetched'.PHP_EOL;
    }
    public function save(){
        echo 'A order was saved'.PHP_EOL;
    }
    public function delete(){
        echo 'A order was deleted'.PHP_EOL;
    }
}
?>