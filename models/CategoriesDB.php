<?php require_once 'db.php' ?>
<?php

class CategoriesDatabase extends DB
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `sp_categories`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>