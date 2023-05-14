<?php
require_once(__DIR__.'/Database.php');
class ProductsDB extends Database{
    function getItem($good_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_goods WHERE good_id=?");
        $statement->bindParam(1, $good_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
    
    function getItemByOffset($offset, $itemsCountPerPage)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_goods ORDER BY good_id ASC LIMIT ? OFFSET ?");
        $statement->bindParam(1, $itemsCountPerPage, PDO::PARAM_INT);
        $statement->bindParam(2, $offset, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}


?>