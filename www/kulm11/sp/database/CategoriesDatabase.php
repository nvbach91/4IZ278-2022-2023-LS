<?php
require_once "Database.php";

class CategoriesDatabase extends Database
{

    public function fetchAll() {
        $query = "SELECT * FROM category";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}