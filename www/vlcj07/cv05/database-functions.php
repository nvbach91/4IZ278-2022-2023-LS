<?php 

interface DatabaseOperations {
    public function fetch($id);
    public function create($args);
    public function save($id, $args);
    public function delete($id, $args);
} 

abstract class Database implements DatabaseOperations {
    protected $dbPath = './db/';
    protected $dbExtension = '.db';
    protected $delimiter = ';';

    public function __construct()
    {
        echo '<br>' . '-----' . static::class . ' was instantiated-----' . PHP_EOL . '<br>'. '<br>';
    }

    public function __toString()
    {
        return "database config: dbPath: $this->dbPath, dbExtension: $this->dbExtension, delimiter: $this->delimiter";
    }

    public function configInfo() {
        echo $this;
    }

 

}

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

class UsersDB extends Database {

    protected $dbFile = "users";
    public function __construct()
     {
         parent::__construct();
         $this->dbPath = $this->dbPath . $this->dbFile . $this->dbExtension;
     }

    public function create($args) { 
        $newRecord = $args['name'].$this->delimiter.$args['age'].$this->delimiter.$args['id'] . PHP_EOL;
        file_put_contents($this->dbPath, $newRecord, FILE_APPEND);

        echo 'User ', $args['name'], ' age: ', $args['age'],' id: ', $args['id'],' was created', PHP_EOL, "<br>"; 
    }
    public function fetch($id)  { 
        file_get_contents($this->dbPath);

        echo 'A user ' . $id . ' was fetched', PHP_EOL, "<br>"; }

    public function save($id, $args)   { 
        $updatedRecord = $id.$this->delimiter.$args['name'].$this->delimiter.$args['age'] . PHP_EOL;
        file_put_contents($this->dbPath, $updatedRecord);

        echo 'A user ' . $id . ' was saved  ', PHP_EOL, "<br>"; }
    public function delete($id, $args) { 
        echo 'A user ' .$args['name']. ' was deleted', PHP_EOL, "<br>";
    }
}

