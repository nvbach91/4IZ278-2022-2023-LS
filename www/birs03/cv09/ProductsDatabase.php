<?php require_once './Database.php';?>
<?php 

class ProductsDatabase extends Database{

    function getTotalRecortds(){
        $statement=$this->pdo->prepare("SELECT COUNT(*) AS count FROM cv09_goods");
        $statement->execute();
        $result = $statement->fetchAll()[0]['count'];
        return $result;
    }

    function fetchRecords($itemsCountPerPage,$offset){
        $query = "SELECT * FROM cv09_goods ORDER BY good_id ASC LIMIT $itemsCountPerPage OFFSET ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1,$offset,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    function getRecortdsById($in_array){
        $in  = str_repeat('?,', count($in_array) - 1) . '?';
        $statement=$this->pdo->prepare("SELECT * FROM cv09_goods WHERE good_id IN ($in)");
        $statement->execute($in_array);
        $result = $statement->fetchAll();
        return $result;
    }

    function getRecordById($id){
        $statement=$this->pdo->prepare("SELECT * FROM cv09_goods WHERE good_id = $id");
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    function editRecord($id,$name,$price){
        $statement=$this->pdo->prepare("UPDATE cv09_goods SET name=?, price=? WHERE good_id = $id");
        $statement->execute([$name,$price]);
    }

    function deleteRecord($id){
        $statement=$this->pdo->prepare("DELETE FROM cv09_goods WHERE good_id = $id");
        $statement->execute();
    }

    function addRecord($name,$price,$description,$img){
        $statement=$this->pdo->prepare("INSERT INTO cv09_goods (name,price,description,img) VALUES (?,?,?,?)");
        $statement->execute([$name,$price,$description,$img]);
    }
}

?>