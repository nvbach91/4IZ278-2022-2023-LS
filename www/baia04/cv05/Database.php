<?php 
include('./DatabaseOperations.php');
abstract class Database implements DatabaseOperations {
    protected $dbPath = './database/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    public function constructorInfo() {
        return '-----' . static::class . ' was instantiated-----' . PHP_EOL;
    }
    public function __toString() {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }
    public function configInfo() { 
        return $this;
    }
}

?>