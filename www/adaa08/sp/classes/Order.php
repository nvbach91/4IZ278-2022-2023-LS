<?php

class Order
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getOrdersByUserId($userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM shop_order WHERE users_user_id = ? ORDER BY order_date DESC');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersByStatus($status)
    {
        $stmt = $this->db->prepare('SELECT * FROM shop_order WHERE status = ?');
        $stmt->bind_param('s', $status);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderItems($orderId) {
        $stmt = $this->db->prepare('SELECT * FROM order_items WHERE shop_order_order_id = ?');
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function deleteOrderItem($orderItemId) {
        $stmt = $this->db->prepare('DELETE FROM order_items WHERE order_items_id = ?');
        $stmt->bind_param('i', $orderItemId);
        $stmt->execute();
    }
    
    public function deleteOrder($orderId) {
        $stmt = $this->db->prepare('DELETE FROM shop_order WHERE order_id = ?');
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
    }

    public function updateOrderStatus($orderId, $status)
    {
        $stmt = $this->db->prepare('UPDATE shop_order SET status = ? WHERE order_id = ?');
        $stmt->bind_param('si', $status, $orderId);
        return $stmt->execute();
    }

    public function createOrder($userId, $addressId, $total, $status)
    {
    $stmt = $this->db->prepare('INSERT INTO shop_order (users_user_id, address_id, total, status, order_date) VALUES (?, ?, ?, ?, NOW())');
    $stmt->bind_param('iids', $userId, $addressId, $total, $status);
    $stmt->execute();
        
    return $this->db->getInsertId();
    }


    public function createOrderItem($orderId, $productId, $quantity, $price)
{
    $stmt = $this->db->prepare('INSERT INTO order_items (shop_order_order_id, products_product_id, quantity, price) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('iiid', $orderId, $productId, $quantity, $price);
    $stmt->execute();
}



}

?>
