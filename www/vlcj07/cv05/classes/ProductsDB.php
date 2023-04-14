<?php 

require_once 'Database.php';

class ProductsDB extends Database {

protected $dbFile = "products";
public function __construct()
 {
     parent::__construct();
     $this->dbPath = $this->dbPath . $this->dbFile . $this->dbExtension;
 }

public function create($args) { 
    $newRecord = $args['name'].$this->delimiter.$args['price'] . PHP_EOL;
    file_put_contents($this->dbPath, $newRecord, FILE_APPEND);

    echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL, "<br>"; 
}
public function fetch($id)  { 
    file_get_contents($this->dbPath);

    echo 'A product ' . $id . ' was fetched', PHP_EOL, "<br>"; 
}
public function save($id, $args)   { 
    $updatedRecord = $id.$this->delimiter.$args['name'].$this->delimiter.$args['price'] . PHP_EOL;
    file_put_contents($this->dbPath, $updatedRecord);

    echo 'A product ' . $id . ' was saved  ', PHP_EOL, "<br>"; 
}
public function delete($id, $args) { 
    echo 'A product ' . $args['name'] .' was deleted', PHP_EOL, "<br>";
    
}
}