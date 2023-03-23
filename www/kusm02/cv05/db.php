<?php
abstract class Database implements DatabaseOperations {
    protected $dbPath = '/app/db/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    public function __construct() {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL . '<br>';
    }
    public function __toString() {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }
    public function configInfo() { 
        echo $this . '<br>';
    }
}
?>