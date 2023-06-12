<?php
require_once 'Database.php';

class OrderDB extends Teadatabase
{

    public function getAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `order`");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByID($orderId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `order` WHERE order_id = ?");
        $stmt->bindValue(1, $orderId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($orderData)
    {
        $sql = "INSERT INTO `order` (user_id, total_price, date, payment_method, status, billing_address_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $orderData['user_id'],
            $orderData['total_price'],
            $orderData['date'],
            $orderData['payment_method'],
            $orderData['status'],
            $orderData['billing_address_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($orderId, $orderData)
    {
        $sql = "UPDATE `order` SET user_id = ?, total_price = ?, date = ?, payment_method = ?, status = ?, billing_address_id = ? WHERE order_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $orderData['user_id'],
            $orderData['total_price'],
            $orderData['date'],
            $orderData['payment_method'],
            $orderData['status'],
            $orderData['billing_address_id'],
            $orderId
        ]);
    }

    public function delete($orderId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `order` WHERE order_id = ?");
        $stmt->bindValue(1, $orderId);
        $stmt->execute();
    }

    public function getPendingByUserId($userId)
    {
        $sql = "SELECT `order`.order_id, orderitem.quantity, product.price, product.name, product.image_url, product.product_id 
                FROM `order` 
                JOIN orderitem ON `order`.order_id = orderitem.order_id 
                JOIN product ON orderitem.product_id = product.product_id 
                WHERE `order`.user_id = ? AND `order`.status = 'pending'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $userId);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getPendingOrderIdByUserId($userId)
    {
        $sql = "SELECT order_id FROM `order` WHERE user_id = ? AND status = 'pending'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $userId);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function createPending($userId)
    {
        $sql = "INSERT INTO `order` (user_id, status) VALUES (?, 'pending')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $userId);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }


    public function getPendingOrderByUser($userId)
    {
        $stmt = $this->pdo->prepare("SELECT order_id FROM `order` WHERE user_id = ? AND status = 'pending'");
        $stmt->bindValue(1, $userId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getOrdersByUserId($userId)
    {
        $sql = "SELECT o.order_id, o.date
        FROM `order` o 
        WHERE o.user_id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $userId);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function markAsCompleted($orderId)
    {
        $sql = "UPDATE `order` SET status = 'completed' WHERE order_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderId);
        $stmt->execute();
    }

    public function getTotalPriceByUserId($userId)
    {
        $sql = "SELECT SUM(price * quantity) as total_price 
            FROM orderitem 
            JOIN `order` ON orderitem.order_id = `order`.order_id 
            WHERE `order`.user_id = ? 
            AND `order`.status = 'pending'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetch();

        return $result ? $result['total_price'] : 0;
    }

    public function getProductsByOrderId($orderId)
    {
        $sql = "SELECT p.product_id, p.name, p.image_url, p.price, oi.quantity, o.total_price
            FROM `orderitem` oi 
            INNER JOIN `product` p ON oi.product_id = p.product_id
            INNER JOIN `order` o ON oi.order_id = o.order_id
            WHERE oi.order_id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $orderId);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
