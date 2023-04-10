<?php 

require_once 'Database.php';

class OrdersDB extends Database {

protected $dbFile = "orders";
public function __construct()
 {
     parent::__construct();
     $this->dbPath = $this->dbPath . $this->dbFile . $this->dbExtension;
 }

public function create($args) { 
    $newRecord = $args['number'].$this->delimiter.$args["date"] . PHP_EOL;
    file_put_contents($this->dbPath, $newRecord, FILE_APPEND);

    echo 'Order', $args['number'], ' was created', PHP_EOL, "<br>"; 
}

public function fetch($id)  { 
    file_get_contents($this->dbPath);

    echo 'An order ' . $id . ' was fetched', PHP_EOL, "<br>"; 
}

public function save($id, $args)   {
    $updatedRecord = $id.$this->delimiter.$args["date"] . PHP_EOL;
    file_put_contents($this->dbPath, $updatedRecord);

    echo 'An order ' . $id . ' was saved  ', PHP_EOL, "<br>"; 
}
public function delete($id, $args) { 
    echo 'An order ' . $args['number'].'  was deleted', PHP_EOL, "<br>"; 
}
}