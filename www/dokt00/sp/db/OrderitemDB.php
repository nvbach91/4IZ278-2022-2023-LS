<?php
require_once 'Database.php';
require_once 'ProductDB.php';

class OrderitemDB extends Teadatabase
{

    public function getByID($orderitemId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orderitem WHERE orderitem_id = ?");
        $stmt->bindValue(1, $orderitemId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($orderitemData)
    {
        $sql = "INSERT INTO orderitem (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $orderitemData['order_id'],
            $orderitemData['product_id'],
            $orderitemData['quantity'],
            $orderitemData['price']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function create($orderId, $productId)
    {

        $productDB = new ProductDB();
        $product = $productDB->getByID($productId);
        $price = $product['price'];

        $sql = "INSERT INTO orderitem (order_id, product_id, quantity, price) VALUES (?, ?, 1, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderId);
        $stmt->bindValue(2, $productId);
        $stmt->bindValue(3, $price);
        $stmt->execute();
    }

    public function update($orderitemId, $newQuantity)
    {
        $sql = "UPDATE orderitem SET quantity = ? WHERE orderitem_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $newQuantity);
        $stmt->bindValue(2, $orderitemId);
        $stmt->execute();
    }

    public function delete($orderitemId)
    {
        $sql = "DELETE FROM orderitem WHERE orderitem_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderitemId);
        $stmt->execute();
    }


    public function getByOrderAndProductId($orderId, $productId)
    {
        $sql = "SELECT orderitem_id FROM orderitem WHERE order_id = ? AND product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderId);
        $stmt->bindValue(2, $productId);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function increaseQuantity($orderitemId)
    {
        $sql = "UPDATE orderitem SET quantity = quantity + 1 WHERE orderitem_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderitemId);
        $stmt->execute();
    }

    public function decreaseQuantity($orderitemId)
    {
        $sql = "UPDATE orderitem SET quantity = quantity - 1 WHERE orderitem_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderitemId);
        $stmt->execute();
    }

    public function getAllByOrderId($orderId)
    {
        $sql = "SELECT * FROM orderitem WHERE order_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPriceByOrderId($orderId)
    {
        $sql = "SELECT SUM(p.price * oi.quantity) as total_price
            FROM `orderitem` oi
            INNER JOIN `product` p ON oi.product_id = p.product_id
            WHERE oi.order_id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
        $result = $stmt->fetch();

        return $result ? $result['total_price'] : 0;
    }
}
