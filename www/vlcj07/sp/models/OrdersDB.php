<?php require_once 'db.php' ?>
<?php

class OrdersDatabase extends DB
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `sp_orders`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function createOrder($status, $total_price, $date, $user_id)
    {
        $query = 'INSERT INTO sp_orders(status, total_price, date, user_id) VALUES (:status, :total_price, :date, :user_id)';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['status' => $status, 'total_price' => $total_price, 'date' => $date, 'user_id' => $user_id]);
    }

    public function fetchByUserId($user_id)
    {
        $query = 'SELECT * FROM sp_orders WHERE user_id = :user_id ORDER BY date DESC LIMIT 1';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['user_id' => $user_id]);
        return $statement->fetchAll()[0];
    }

    public function fetchAllByUserId($user_id)
    {
        $query = 'SELECT * FROM sp_orders WHERE user_id = :user_id ORDER BY date';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['user_id' => $user_id]);
        return $statement->fetchAll();
    }

    public function fetchByOrderId($order_id)
    {
        $query = 'SELECT * FROM sp_orders WHERE order_id = :order_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['order_id' => $order_id]);
        return $statement->fetchAll()[0];
    }

    public function updateOrder($order_id, $status, $date, $user_id, $total_price)
    {
        $query = "UPDATE `sp_orders`  SET status = :status, user_id = :user_id, date = :date, total_price = :total_price WHERE order_id = :order_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(['order_id' => $order_id, 'status' => $status, 'user_id' => $user_id, 'total_price' => $total_price, 'date' => $date]);
    }
}
?>