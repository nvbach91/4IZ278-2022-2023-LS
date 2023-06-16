<?php require_once './dbconfig.php' ?>
<?php require_once './database.php' ?>
<?php


class CategoriesDatabase extends Database
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `sp_categories`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
