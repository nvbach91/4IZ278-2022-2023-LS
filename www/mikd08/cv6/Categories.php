<?php 
    require_once "Database.php";
    
    class Categories extends Database{
        public function fetchAll() {
            $query = "select * from categories";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        }
    }
?>