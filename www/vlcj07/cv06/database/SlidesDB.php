<?php require_once 'DB.php' ?>
<?php

class SlidesDatabase extends DB {
    public function fetchAll() {
        $query = "SELECT * FROM `cv06_slides`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}


?>