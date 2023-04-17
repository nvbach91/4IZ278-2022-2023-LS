<?php

require_once('./Database.php');

class ProductsDB extends Database{
    public function fetchByCategories($category){
        $query="SELECT * FROM `cv06_products` WHERE category_id=".$category.";";
        $statement=$this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchAll(){
        $query="SELECT * FROM `cv06_products`;";
        $statement=$this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>