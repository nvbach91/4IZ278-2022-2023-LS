<?php require_once './database-operations.php'; ?>
<?php

abstract class Database implements DatabaseOperations
{
    protected $dbPath = '/db/';
    protected $dbExtension = '.csv';
    protected $dbSeparator = ';';

    public function __construct()
    {
        echo "Creating instance of " . static::class . PHP_EOL;
    }

    public function __toString()
    {
        return "DB configuration:" . PHP_EOL . "path: " . $this->dbPath . PHP_EOL .
            "extension: " . $this->dbExtension . PHP_EOL .
            "separator: " . $this->dbSeparator . PHP_EOL;
    }
}
?>