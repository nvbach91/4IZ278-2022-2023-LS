<?php
require_once './pdo.php';

class AdressesDatabase extends Database
{
    private $primaryKey = 1;
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }
    public function fetchAll()
    {
        $query = "SELECT * FROM `adresses`"; //zmenit na backtics
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getId($email)
    {
        $query = "SELECT adress_id FROM adresses WHERE  = '$email'";
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute();
        return $result;
    }
}
