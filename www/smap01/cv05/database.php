<?php include "./databaseOperations.php" ?>

<?php

abstract class Database implements databaseOperations
{
    protected $dbPath = './database/';
    protected $dbExtension = '.db';
    protected $separator = ';';

    public function __construct()
    {
        $database = fopen($this->dbPath . static::class . $this->dbExtension, 'w');
        fclose($database);
        echo '<br>Database class ' . static::class . ' was initialized.</br>' . PHP_EOL;
    }
    public function __toString()
    {
        return "Database " . static::class . " with a path '<i>" . $this->dbPath . $this->dbExtension . "</i>' with a delimeter '<i>" . $this->separator . "</i>'." . PHP_EOL;
    }
    public function getFilePath()
    {
        return $this->dbPath . static::class . $this->dbExtension;
    }
}

?>