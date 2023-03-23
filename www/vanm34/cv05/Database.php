<?php
require_once 'DatabaseOperations.php';
abstract class Database implements DatabaseOperations{

    protected $dbPath = './db';
    protected $extension = '.db';
    protected $separator  = ';';
    
    public function __construct(){
      echo '<b>Class ', static::class, ' was contrstructed.</b>', PHP_EOL;
    }

    public function __toString() {
        return "Database Configuration:" . PHP_EOL . 
                "DB Path: " . $this->dbPath . PHP_EOL . 
                "DB Extension: " . $this->extension . PHP_EOL . 
                "Field Separator: " . $this->separator . PHP_EOL;
    }


}

?>