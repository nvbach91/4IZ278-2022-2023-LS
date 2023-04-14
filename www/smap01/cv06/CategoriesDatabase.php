<?php
require_once("./Database.php");

class CategoriesDatabase extends Database
{

    public function fetchAll()
    {
        try {
            $query = "SELECT * FROM `categories`";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            exit("Encountered error: $e");
        }
        return;
    }
}
