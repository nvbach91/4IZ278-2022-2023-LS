<?php 
require_once "./DatabaseOperations.php";

abstract Class Database implements DatabaseOperations{
    protected $dbPath ='/db';
    protected $dbExtension= '.db';
    protected $separator = ';';

    public function __construct(
    ){
    echo PHP_EOL."-------- ".static::class." was created-------".PHP_EOL;
    }
    public function __toString(){
        return "db config: dbPath: $this->dbPath, dbExtension: $this->dbExtension, separator: $this->separator";
    }
    public function configInfo(){
        echo $this;
    }   
}
