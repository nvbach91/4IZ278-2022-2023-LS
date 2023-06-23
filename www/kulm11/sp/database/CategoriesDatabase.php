<?php
require_once "Database.php";

class CategoriesDatabase extends Database
{
    public function fetch($id)
    {
        $query = "SELECT * FROM category where categoryid=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        return $statement->fetch();
    }

    public function fetchAll()
    {
        $query = "SELECT * FROM category";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
