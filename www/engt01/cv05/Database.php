<?php
require_once "DatabaseOperations.php";

abstract class Database implements DatabaseOperations {
    protected string $path = "/db/";
    protected string $extension = "csv";
    protected string $delim = ";";

    public function __construct() {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }

    public function __toString(): string {
        return "Database config: path=$this->path, extension=$this->extension, delimeter=$this->delim";
    }
}