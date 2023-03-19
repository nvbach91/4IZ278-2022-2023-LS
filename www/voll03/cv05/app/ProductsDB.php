<?php

class ProductsDB extends Database
{
    protected $dbFileName = "products";

    public function __construct()
    {
        parent::__construct();
        $this->dbPath = $this->dbPath . $this->dbFileName . $this->dbExtension;

        if (!$this->load()) {
            throw new Exception("*SERVER ERROR: Can't connect to database!");
        }
    }

    public function load()
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        $fileContent = explode(PHP_EOL, file_get_contents($this->dbPath));


        foreach ($fileContent as $line) {
            $fields = explode($this->delimeter, $line);

            if (count($fields) === 3) {
                array_push($this->tableRows, [
                    "id" => $fields[0],
                    "name" => $fields[1],
                    "price" => $fields[2]
                ]);
            }
        }

        return self::RESULT_SUCCESS;
    }

    public function create(array $record)
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        if (empty($record)) {
            return self::ERROR_EMPTY_ARGS;
        }

        if (!isset($record['name']) || !isset($record['price'])) {
            return self::ERROR_INVALID_ARGS;
        }

        if ($this->fetchByName($record['name']) !== null) {
            return self::ERROR_RECORD_ALREADY_EXISTS;
        }

        $id = $this->generateAutoIncrementID();

        // update internal array
        array_push($this->tableRows, [
            "id" => $id,
            "name" => $record['name'],
            "price" => $record['price']
        ]);

        // update file
        $newRecord = $id . $this->delimeter . implode($this->delimeter, $record) . PHP_EOL;
        file_put_contents($this->dbPath, $newRecord, FILE_APPEND);

        echo "Product " . $record['name'] . " was created. <br>";

        return self::RESULT_SUCCESS;
    }

    public function fetchAll()
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        echo "Fetched all rows from Products table:<br>";

        foreach($this->tableRows as $row) {
            echo "Product id: " . $row['id'] . "; name: " . $row['name'] . "; price: " . $row['price'] . "<br>";
        }

        echo "--------------<br><br>";

        return $this->tableRows;
    }

    public function fetchByID(int $id)
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        if (!isset($id) || empty($id) || $id === null) {
            return self::ERROR_EMPTY_ARGS;
        }

        // fetch from internal array
        foreach ($this->tableRows as $row) {
            if ($row['id'] === $id) {
                echo "Fetched product with id " . $id . ":<br>";
                echo "Product id: " . $row['id'] . "; name: " . $row['name'] . "; price: " . $row['price'] . "<br>";
                echo "--------------<br><br>";
                return $row;
            }
        }

        echo "No product with id " . $id . " was found.<br>";

        return self::RESULT_NOTHING;
    }

    public function fetchByName(string $name)
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        if (!isset($name) || empty($name) || $name === null) {
            return self::ERROR_EMPTY_ARGS;
        }

        // fetch from internal array
        foreach ($this->tableRows as $row) {;
            if ($row['name'] === $name) {
                echo "Fetched product with name " . $row['name'] . ":<br>";
                echo "Product id: " . $row['id'] . "; name: " . $row['name'] . "; price: " . $row['price'] . "<br>";
                echo "--------------<br><br>";
                return $row;
            }
        }

        echo "No product with name " . $name . " was found.<br>";

        return null;
    }

    public function update(int $id, array $record)
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        if (!isset($record) || empty($record) || $record === null || !isset($id) || empty($id) || $id === null) {
            return self::ERROR_EMPTY_ARGS;
        }

        if (!isset($record['name']) || !isset($record['price'])) {
            return self::ERROR_INVALID_ARGS;
        }

        if (!$this->fetchByID($id)) {
            return self::ERROR_RECORD_NOT_EXISTS;
        }

        // update internal array
        $index = 0;
        foreach ($this->tableRows as $row) {
            if ($row['id'] === $id) {
                $this->tableRows[$index] = [
                    "id" => $id,
                    "name" => $record['name'],
                    "price" => $record['price']
                ];
                break;
            }

            $index++;
        }

        // update file
        $newContent = "";

        foreach ($this->tableRows as $row) {
            $newContent .= implode($this->delimeter, $row) . PHP_EOL;
        }

        file_put_contents($this->dbPath, $newContent);

        echo "Product with id " . $id . " was updated.<br>";
        return self::RESULT_SUCCESS;
    }

    public function delete(int $id)
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        if (!isset($id) || empty($id) || $id === null) {
            return self::ERROR_EMPTY_ARGS;
        }

        if (!$this->fetchByID($id)) {
            return self::ERROR_RECORD_NOT_EXISTS;
        }

        // update internal array
        $index = 0;
        foreach ($this->tableRows as $row) {
            if ($row['id'] === $id) {
                array_splice($this->tableRows, $index, 1);
                break;
            }

            $index++;
        }

        // update file
        $newContent = "";

        foreach ($this->tableRows as $row) {
            $newContent .= implode($this->delimeter, $row) . PHP_EOL;
        }

        file_put_contents($this->dbPath, $newContent);

        echo "Product with id " . $id . " was deleted.<br>";
        return self::RESULT_SUCCESS;
    }

    public function deleteAll()
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        $this->tableRows = [];
        file_put_contents($this->dbPath, "");

        echo "All products have been removed.<br>";
        echo "--------------<br><br>";
        return self::RESULT_SUCCESS;
    }
}
