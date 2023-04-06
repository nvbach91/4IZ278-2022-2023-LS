<?php 
require_once ('./DatabaseOperations.php');
abstract class Database implements DatabaseOperations {
    protected $dbPath = '/db/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    public function __construct() {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }
    public function __toString() {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }
}
?>
