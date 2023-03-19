<?php

abstract class Database implements DatabaseOperations
{
    const RESULT_SUCCESS = 1;
    const RESULT_NOTHING = 0;
    const ERROR_EMPTY_ARGS = -1;
    const ERROR_INVALID_ARGS = -2;
    const ERROR_CONNECTION_FAILED = -3;
    const ERROR_RECORD_NOT_EXISTS = -4;
    const ERROR_RECORD_ALREADY_EXISTS = -5;

    protected $dbPath = './db/';
    protected $dbExtension = '.db';
    protected $delimeter = ';';
    protected array $tableRows;

    public function __construct()
    {
        $this->tableRows = [];
        echo '-----' . static::class . ' was instantiated-----' . '<br>';
    }

    public function __toString()
    {
        return get_class($this) . " config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimeter <br>";
    }

    public function checkConnection(): bool
    {
        return file_exists($this->dbPath);
    }

    public function getTableRows(): array
    {
        return $this->tableRows;
    }

    public function getDbPath(): string
    {
        return $this->dbPath;
    }

    public function configInfo()
    {
        echo $this;
    }

    protected function generateAutoIncrementID()
    {
        if (count($this->tableRows) === 0) {
            return 1;
        }

        $max = 1;

        foreach ($this->tableRows as $row) {
            if ($row['id'] > $max) {
                $max = $row['id'];
            }
        }

        return $max + 1;
    }
}
