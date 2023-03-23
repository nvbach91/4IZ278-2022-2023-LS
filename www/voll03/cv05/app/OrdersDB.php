<?php

class OrdersDB extends Database
{
    protected $dbFileName = "orders";

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

            if (count($fields) === 5) {
                array_push($this->tableRows, [
                    "id" => $fields[0],
                    "number" => $fields[1],
                    "date" => $fields[2],
                    "user_id" => $fields[3],
                    "product_id" => $fields[4]
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

        if (!isset($record['number']) || !isset($record['date']) || !isset($record['user_id']) || !isset($record['product_id'])) {
            return self::ERROR_INVALID_ARGS;
        }

        if ($this->fetchByName($record['number']) !== null) {
            return self::ERROR_RECORD_ALREADY_EXISTS;
        }

        $id = $this->generateAutoIncrementID();

        // update internal array
        array_push($this->tableRows, [
            "id" => $id,
            "number" => $record['number'],
            "date" => $record['date'],
            "user_id" => $record['user_id'],
            "product_id" => $record['product_id']
        ]);

        // update file
        $newRecord = $id . $this->delimeter . implode($this->delimeter, $record) . PHP_EOL;
        file_put_contents($this->dbPath, $newRecord, FILE_APPEND);

        echo "Order no. " . $record['number'] . " was created. <br>";
        return self::RESULT_SUCCESS;
    }

    public function fetchAll()
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        echo "Fetched all rows from Orders table:<br>";

        foreach($this->tableRows as $row) {
            echo "Order id: " . $row['id'] . "; number: " . $row['number'] . "; date: " . $row['date'] . "; user_id: " . $row['user_id'] . "; product_id: " . $row['product_id'] .  "<br>";
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
                echo "Fetched order with id " . $id . ":<br>";
                echo "Order id: " . $row['id'] . "; number: " . $row['number'] . "; date: " . $row['date'] . "; user_id: " . $row['user_id'] . "; product_id: " . $row['product_id'] .  "<br>";
                echo "--------------<br><br>";
                return $row;
            }
        }

        echo "No order with id " . $id . " was found.<br>";

        return self::RESULT_NOTHING;
    }

    public function fetchByName(string | int $name)
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        if (!isset($name) || empty($name) || $name === null) {
            return self::ERROR_EMPTY_ARGS;
        }

        // fetch from internal array
        foreach ($this->tableRows as $row) {;
            if ($row['number'] === $name) {
                echo "Fetched order with number " . $name . ":<br>";
                echo "Order id: " . $row['id'] . "; number: " . $row['number'] . "; date: " . $row['date'] . "; user_id: " . $row['user_id'] . "; product_id: " . $row['product_id'] .  "<br>";
                echo "--------------<br><br>";
                return $row;
            }
        }
    
        echo "No order with number " . $name . " was found.<br>";
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

        if (!isset($record['number']) || !isset($record['date']) || !isset($record['user_id']) || !isset($record['product_id'])) {
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
                    "number" => $record['number'],
                    "date" => $record['date'],
                    "user_id" => $record['user_id'],
                    "product_id" => $record['product_id']
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

        echo "Order with id " . $id . " was updated.<br>";
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

        echo "Order with id " . $id . " was deleted.<br>";
        return self::RESULT_SUCCESS;
    }

    public function deleteAll()
    {
        if (!$this->checkConnection()) {
            return self::ERROR_CONNECTION_FAILED;
        }

        $this->tableRows = [];
        file_put_contents($this->dbPath, "");

        echo "All orders have been removed.<br>";
        echo "--------------<br><br>";
        return self::RESULT_SUCCESS;
    }
}
