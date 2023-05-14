<?php require_once 'db.php' ?>
<?php 

class OrdersDatabase extends DB {
    public function fetchAll(){
        $query = "SELECT * FROM `sp_orders`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function createOrder($status, $total_price, $date, $user_id){
        $query = 'INSERT INTO sp_orders(status, total_price, date, user_id) VALUES (:status, :total_price, :date, :user_id)';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['status' => $status, 'total_price' => $total_price, 'date' => $date, 'user_id' => $user_id]);
    }

    public function fetchByUserId($user_id){
        $query = 'SELECT * FROM sp_orders WHERE user_id = :user_id ORDER BY date DESC LIMIT 1';
        $statement = $this->pdo->prepare($query); 
        $statement->execute(['user_id' => $user_id]);
        return $statement->fetchAll()[0];
    }
}
?>