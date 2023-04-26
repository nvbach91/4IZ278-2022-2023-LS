<?php

require_once('database.php');

class ProductsDatabase extends Database {
    

    
    public function fetchAll($page, $maxProducts, $order){
        $offset = 0;

        $offset = ($page-1)*$maxProducts;

        $query = "SELECT * FROM `products` ORDER BY $order LIMIT $maxProducts OFFSET $offset";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getAll(){
        $query = "SELECT * FROM `products` ORDER BY name";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getSliderItems(){
        $query = "SELECT * FROM `products` WHERE marked = 1";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCountByCategory($category_id){
        $query = "SELECT * FROM `products` WHERE category = $category_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return count($statement->fetchAll());
    }

    public function getCount(){
        $query = "SELECT * FROM `products`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return count($statement->fetchAll());
    }

    public function fetchCategory($category_id, $page, $maxProducts, $order){
        $offset = 0;

        $offset = ($page-1)*$maxProducts;

        $query = "SELECT * FROM `products` WHERE category = $category_id ORDER BY $order LIMIT $maxProducts OFFSET $offset";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }


    public function getProductById($id){
        $query = "SELECT * FROM `products` WHERE product_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
        return $statement->fetchAll()[0];
    }


    public function insertProduct($name, $category, $price, $image, $description){
        $sql = "INSERT INTO products (name, price, category, image, description) VALUES (:name, :price, :category, :image, :description)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        header("Location: databaseManager.php"); 
    }

    public function editProduct($id, $name, $category, $price, $image, $description){
        $sql = "UPDATE products SET name='$name', category='$category', price='$price', image='$image', description='$description' WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location: databaseManager.php");    
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $this->pdo->lastInsertId();
    
    }

}

?>