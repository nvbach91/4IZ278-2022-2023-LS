<?php
require_once "./Database.php";

class ItemsDatabase extends Database
{

    public function fetchAll() {
        $query = "SELECT * FROM item";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}