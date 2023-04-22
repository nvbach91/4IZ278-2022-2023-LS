<?php

require_once('database.php');

class ProductsDatabase extends Database {
    

    
    public function fetchAll($page, $maxProducts){
        if(isset($_GET['ordered'])){
            $order = $_GET('ordered');
        }
        else {
            $order = "product_id";
        }

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

    public function fetchCategory($category_id, $page, $maxProducts){
        if(isset($_GET['ordered'])){
            $order = $_GET('ordered');
        }
        else {
            $order = "product_id";
        }

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


    public function insertProduct($name, $category, $price, $image){
        $sql = "INSERT INTO products (name, price, category, image) VALUES (:name, :price, :category, :image)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        header("Location: productManager.php"); 
    }

    public function editProduct($id, $name, $category, $price, $image){
        $sql = "UPDATE products SET name='$name', category='$category', price='$price', image='$image' WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location: productManager.php");    
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $this->pdo->lastInsertId();
    
    }

}

?>