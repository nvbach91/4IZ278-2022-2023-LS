<?php

require_once('database.php');

class CategoriesDatabase extends Database {
    public function fetchAll(){
        $query = "SELECT * FROM `categories`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCategoryName($category_id){
        $query = "SELECT * FROM `categories` WHERE category_id= $category_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $row = $statement->fetch();
        return $row["name"];
    }
}

?>