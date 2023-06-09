<?php require_once 'Database.php';?>
<?php 

class OrdersDatabase extends Database{

    function addOrder($user_id,$date,$amount){
        $statement=$this->pdo->prepare("INSERT INTO orders (user_id,date,amount) VALUES (?,?,?)");
        $statement->execute([$user_id,$date,$amount]);
        return $this->pdo->lastInsertId();
    }

    public function fetchAll($user_id){
        $query = "SELECT * FROM orders WHERE user_id = $user_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>