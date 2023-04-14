<?php require_once 'DB.php' ?>
<?php

class CategoriesDatabase extends DB {
    public function fetchAll() {
        $query = "SELECT * FROM `cv06_categories`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}


?>