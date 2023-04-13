<?php

require_once('database/database.php');



class ProductsDatabase extends Database {
    

    
    public function fetchAll(){
        if(isset($_GET['ordered'])){
            $order = $_GET('ordered');
        }
        else {
            $order = "product_id";
        }

        $query = "SELECT * FROM `products` ORDER BY $order";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchCategory($category_id){
        if(isset($_GET['ordered'])){
            $order = $_GET('ordered');
        }
        else {
            $order = "product_id";
        }

        $query = "SELECT * FROM `products` WHERE category = $category_id ORDER BY $order";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>