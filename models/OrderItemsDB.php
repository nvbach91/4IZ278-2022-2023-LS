<?php require_once 'db.php' ?>
<?php

class OrderItemsDatabase extends DB
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `sp_orderItems`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function createOrder($amount, $price, $product_id, $order_id)
    {
        $query = 'INSERT INTO sp_orderItems(amount, price, product_id, order_id) VALUES (:amount, :price, :product_id, :order_id)';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['amount' => $amount, 'price' => $price, 'product_id' => $product_id, 'order_id' => $order_id]);
    }

    public function fetchAllByOrderId($order_id)
    {
        $query = "SELECT * FROM sp_orderItems WHERE order_id = :order_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(['order_id' => $order_id]);
        return $statement->fetchAll();
    }
}
?>