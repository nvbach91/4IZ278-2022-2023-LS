<?php

$messages = explode(PHP_EOL, file_get_contents("messages.txt"));

file_put_contents("messages.txt", "");


interface DatabaseOperations {

    public function fetch();
    public function create($data);
    public function save($data);
    public function delete($id);
}

abstract class Database implements DatabaseOperations {
    protected $dbPath = 'db/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';


    public function __construct() {
        // what is static::class?
        $messages = array();
        file_put_contents("messages.txt", 'Databáze ' . static::class . ' byla instancována!' . PHP_EOL, FILE_APPEND);
    }

    public function __toString()
    {
      return "DB: $this->dbPath" . static::class . $this->dbExtension;
    }

    public function getPath(){
        return "$this->dbPath" . static::class . $this->dbExtension;
    }

    public function getDelimiter(){
        return $this->delimiter;
    }

}



require 'products.php';
require 'users.php';
require 'orders.php';



$users = new UsersDB();

$products = new ProductsDB();

$orders = new OrdersDB();


?>