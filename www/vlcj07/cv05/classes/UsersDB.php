<?php 

require_once 'Database.php';

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