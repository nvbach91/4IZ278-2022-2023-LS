<?php
require_once "./Database.php";

class UsersDatabase extends Database
{

    public function fetchAll() {
        $query = "SELECT * FROM User";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}