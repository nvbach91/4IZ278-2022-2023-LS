<?php require_once './dbconfig.php' ?>
<?php require_once './database.php' ?>
<?php

class ProductsDatabase extends Database
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `sp_products`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchByCategory($category_id)
    {
        $query = "SELECT * FROM `sp_products` WHERE category_id = :category_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'category_id' => $category_id,
        ]);
        return $statement->fetchAll();
    }
}
