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
    $stmt = $this->db->prepare('SELECT * FROM shop_order WHERE users_user_id = ? AND is_deleted = 0 ORDER BY order_date DESC');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function getOrdersByStatus($status)
{
    $stmt = $this->db->prepare('SELECT * FROM shop_order WHERE status = ? AND is_deleted = 0');
    $stmt->bind_param('s', $status);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function getOrderById($orderId) {
    $stmt = $this->db->prepare('SELECT * FROM shop_order WHERE order_id = ? AND is_deleted = 0');
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


    public function getOrderItems($orderId) {
        $stmt = $this->db->prepare('SELECT oi.quantity, oi.price AS product_price, p.name, p.photo 
                                    FROM order_items oi 
                                    INNER JOIN products p ON oi.products_product_id = p.product_id 
                                    WHERE oi.shop_order_order_id = ?');
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
        $stmt = $this->db->prepare('UPDATE shop_order SET is_deleted = 1 WHERE order_id = ?');
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