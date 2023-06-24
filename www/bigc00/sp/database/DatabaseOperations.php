<?php 
interface DatabaseOperations {
    public function fetchOne(string $tableName, string $field, string $value);
    public function fetchAll(string $tableName, string $field, string $value);
}
?>