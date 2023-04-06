<?php 
    require_once "Database.php";
    class Slides extends Database {
        public function fetchAll() {
            $query = "select img from products";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        }

    }
?>