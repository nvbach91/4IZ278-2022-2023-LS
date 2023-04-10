<?php 

require_once './classes/DatabaseOperations.php';

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