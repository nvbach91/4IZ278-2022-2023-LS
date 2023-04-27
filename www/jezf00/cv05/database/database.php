<?php
require_once './DatabaseOperations.php';

abstract class Database implements DatabaseOperations
{
  protected $dbPath = 'db-storage/';
  protected $dbExtension = '.db';
  protected $separator = ';';
  public function __construct()
  {
    echo '<h2>Database class ', static::class, ' was initialized.</h2>', PHP_EOL;
  }
  public function __toString()
  {
    return "DB: $this->dbPath" . static::class . $this->dbExtension . $this->separator;
  }
  public function filePath()
  {
    return $this->dbPath . static::class . $this->dbExtension;
  }
  public function getSeparator()
  {
    return $this->separator;
  }
}
?>
