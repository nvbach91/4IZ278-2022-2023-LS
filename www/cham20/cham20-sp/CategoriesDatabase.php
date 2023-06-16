<?php
require_once './pdo.php';

class CategoriesDatabase extends Database
{

    public function fetchAll()
    {
        $query = "SELECT * FROM `adresses`"; //zmenit na backtics
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
