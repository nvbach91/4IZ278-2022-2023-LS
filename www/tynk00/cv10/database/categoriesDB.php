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

    public function insertCategory($name, $image){
        $sql = "INSERT INTO categories (name, bg) VALUES (:name, :image)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        header("Location: databaseManager.php?database=categories");    
    }

    public function editCategory($id, $name, $image){
        $sql = "UPDATE categories SET name='$name', bg='$image' WHERE category_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location: databaseManager.php?database=categories");    
    }

    public function deleteCategory($id){
        $sql = "DELETE FROM categories WHERE category_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $this->pdo->lastInsertId();
    
    }
}

?>