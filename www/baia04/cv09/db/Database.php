<?php
require('./config.php');
require('./db/DatabaseInterface.php');
abstract class Database implements DatabaseInterface {
    public $pdo;
    protected $tableName;
    public function __construct() {
        $this -> pdo = new PDO (
            "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ';charset=utf8mb4', DB_USERNAME, DB_PASSWORD
        );

        $this -> pdo -> setAttribute (
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        );

        $this -> pdo -> setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
        );
    }

    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this -> tableName;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
        return $statement -> fetchAll();
    }

    public function fetchBy($field, $value) {
        $statement = $this -> pdo -> prepare('SELECT * FROM `products` WHERE ' . $field . ' = ' . $value );
        $statement -> execute();
        return $statement -> fetchAll();
    }

    public function deleteBy($field, $value) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }

    public function updateBy($conditions, $args) {
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $sets = [];
        foreach($args as $key => $value) {
            $sets[] = $key . ' = :' . $key;
        }
        $sql .= implode(', ', $sets);
        $sql .= ' WHERE ';
        $wheres = [];
        foreach($conditions as $key => $value) {
            $wheres[] = $key . ' = :' . $key;
        }
        $sql .= implode(' && ', $wheres);
        echo $sql;
        $statement = $this->pdo->prepare($sql);
        foreach($args as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }

    public function query($sql, $args) {
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute($args);
        return $statement -> fetchAll();
    }

}

?>