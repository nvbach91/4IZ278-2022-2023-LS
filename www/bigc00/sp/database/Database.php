<?php
require_once('../database/DatabaseOperations.php');
require_once('../database/config.php');
abstract class Database  {
    protected PDO $pdo;
    protected $tableName; 
    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this -> pdo -> setAttribute (
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        );
        $this -> pdo -> setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
        );
    }

    public function fetchOne(string $tableName, string $field, string $value) {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $field . " = :value";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute(['value' => $value]);
        $result = $statement -> fetchAll();
        return count($result) ? $result[0] : false;
    }

    public function fetchAll(string $tableName, string $field, string $value) {
        $sql = "SELECT * FROM " . $tableName . " WHERE " . $field . " = :value";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute(['value' => $value]);
        return $statement -> fetchAll();
    }

    public function update(string $tableName, string $field, string $value, string $whereField, string $whereValue) {
        $sql = "UPDATE " . $tableName . " SET " . $field . " = :value WHERE " . $whereField . " = :whereValue";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            'value' => $value,
            'whereValue' => $whereValue
        ]);
    }
}
?>