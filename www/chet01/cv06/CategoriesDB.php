<?php require_once "./dbconfig.php";
require_once './Database.php';

class CategoriesDB extends Database {
    public function fetchAll()
    {
        $query = "SELECT * FROM `cv6_categories`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
