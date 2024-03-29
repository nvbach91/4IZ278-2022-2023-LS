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
        $existingProduct = $this->getCartItemByProductId($productId, $cartId);

        if ($existingProduct) {
            $newQuantity = $existingProduct['quantity'] + $quantity;
            $stmt = $this->db->prepare('UPDATE shopping_cart_item SET quantity = ? WHERE shopping_cart_cart_id = ? AND products_product_id = ?');
            $stmt->bind_param('iii', $newQuantity, $cartId, $productId);
        } else {
            $stmt = $this->db->prepare('INSERT INTO shopping_cart_item (quantity, products_product_id, shopping_cart_cart_id) VALUES (?, ?, ?)');
            $stmt->bind_param('iii', $quantity, $productId, $cartId);
        }
        $stmt->execute();
    }

    public function getCartItemByProductId($productId, $cartId)
    {
        $stmt = $this->db->prepare('SELECT * FROM shopping_cart_item WHERE products_product_id = ? AND shopping_cart_cart_id = ?');
        $stmt->bind_param('ii', $productId, $cartId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getCartItems($cartId) 
    {
        $stmt = $this->db->prepare('SELECT p.product_id, p.name, p.price, p.photo, sci.quantity FROM shopping_cart_item sci LEFT JOIN products p ON p.product_id = sci.products_product_id WHERE sci.shopping_cart_cart_id = ?');
        $stmt->bind_param('i', $cartId);
        $stmt->execute();
        $result = $stmt->get_result();

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
    $stmt = $this->db->prepare('DELETE FROM shopping_cart_item WHERE shopping_cart_cart_id = ?');
    $stmt->bind_param('i', $cartId);
    $stmt->execute();

    $stmt = $this->db->prepare('DELETE FROM shopping_cart WHERE cart_id = ?');
    $stmt->bind_param('i', $cartId);
    $stmt->execute();
}   

    public function removeFromCart($productId, $cartId)
    {
    $stmt = $this->db->prepare('DELETE FROM shopping_cart_item WHERE products_product_id = ? AND shopping_cart_cart_id = ?');
    $stmt->bind_param('ii', $productId, $cartId);
    $stmt->execute();
    }

    public function getCartIdByUserId($userId) 
    {
    $stmt = $this->db->prepare('SELECT cart_id FROM shopping_cart WHERE users_user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['cart_id'];
    } else {
        return false;
    }
    }



}

?>
