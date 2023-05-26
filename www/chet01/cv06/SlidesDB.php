<?php
require_once './dbconfig.php';
require_once "./Database.php";

class SlidesDB extends Database
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `cv6_slides`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
