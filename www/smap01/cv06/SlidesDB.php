<?php

require_once('./Database.php');

class SlidesDB extends Database{
    public function fetchAll(){
        $query="SELECT * FROM `cv06_slides`;";
        $statement=$this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>