<?php

require_once __DIR__ . '/../interfaces/InterfaceDatabaseOperations.php';

abstract class Database implements DatabseOperations
{
    protected $path = '../../db/';
    protected $ext = '.db';
    protected $delimiter = ';';

    public function __construct()
    {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }

    public function __toString()
    {
        return "database config: path to file: $this->path, dbExtenstion: $this->ext, delimiter: $this->delimiter";
    }

    public function configInfo()
    {
        echo $this;
    }
}

?>