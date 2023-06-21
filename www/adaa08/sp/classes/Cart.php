<?php

class Cart
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createCart($userId) 
    {
        $stmt = $this->db->prepare('INSERT INTO shopping_cart (users_user_id) VALUES (?)');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        return $this->db->getInsertId();
    }

    public function addToCart($quantity, $productId, $cartId)
    {
        $stmt = $this->db->prepare('INSERT INTO shopping_cart_item (quantity, products_product_id, shopping_cart_cart_id) VALUES (?, ?, ?)');
        $stmt->bind_param('iii', $quantity, $productId, $cartId);
        $stmt->execute();
    }

    public function getCartItems($cartId) 
    {
        $stmt = $this->db->prepare('SELECT p.product_id, p.name, p.price, p.photo, sci.quantity FROM shopping_cart_item sci LEFT JOIN products p ON p.product_id = sci.products_product_id WHERE sci.shopping_cart_cart_id = ?');
        $stmt->bind_param('i', $cartId);
        $stmt->execute();
        $result = $stmt->get_result();

        // fetch and sanitize the data
        $data = [];
        while($row = $result->fetch_assoc()) {
            $data[] = array_map(function($value) {
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }, $row);
        }
        
        return $data;
    }

    public function deleteCart($cartId) 
{
    // First, delete all items associated with the cart
    $stmt = $this->db->prepare('DELETE FROM shopping_cart_item WHERE shopping_cart_cart_id = ?');
    $stmt->bind_param('i', $cartId);
    $stmt->execute();

    // Then, delete the cart itself
    $stmt = $this->db->prepare('DELETE FROM shopping_cart WHERE cart_id = ?');
    $stmt->bind_param('i', $cartId);
    $stmt->execute();
}

}

?>
