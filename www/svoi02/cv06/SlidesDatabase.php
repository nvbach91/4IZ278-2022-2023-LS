<?php require_once './Database.php'; ?>

<?php

class SlidesDatabase extends Database {

    public function fetchAll()
    {
        $query = "SELECT * FROM `cv06_slides`";

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }
}

?>