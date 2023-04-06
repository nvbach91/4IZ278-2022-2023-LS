<?php 
    require_once "Database.php";
    class Products extends Database {
        public function fetchAll() {
            $query = "select * from products";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        }

        public function fetchByCategory($category_id) {
            $query = "select * from products where category_id = :category_id";
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "category_id" => $category_id,
            ]);
            return $statement->fetchAll();
        }


    }
?>