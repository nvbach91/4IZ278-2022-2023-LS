<?php

class Admin {
    private $orderObj;
    private $productObj;
    private $userObj;

    public function __construct(Order $orderObj, Product $productObj, User $userObj) {
        $this->orderObj = $orderObj;
        $this->productObj = $productObj;
        $this->userObj = $userObj;

    }

    public function cancelOrder($orderId) {

        $order_items = $this->orderObj->getOrderItems($orderId);

        foreach ($order_items as $item) {

            $this->productObj->updateQuantity($item['products_product_id'], $item['quantity']);
            

            $this->orderObj->deleteOrderItem($item['order_items_id']);
        }


        $this->orderObj->deleteOrder($orderId);
    }

    public function getCurrentOrders() {
        return $this->orderObj->getOrdersByStatus("Spracováva sa");
    }

    public function getCompletedOrders() {
        return $this->orderObj->getOrdersByStatus("Vybavená");
    }

    public function getAllProducts() {
        return $this->productObj->getProducts();
    }
    public function updateProduct($productId, $name, $price, $description, $quantity, $categoryId, $photo)
    {
        if ($photo && is_uploaded_file($photo['tmp_name'])) {
            $target_dir = "pictures/";
            $target_file = $target_dir . basename($photo["name"]);
            $full_url = 'https://esotemp.vse.cz/~adaa08/sp/' . $target_file;
            
            if (!move_uploaded_file($photo["tmp_name"], $target_file)) {
                throw new Exception("File upload failed");
            }
            
            return $this->productObj->updateProduct($productId, $name, $price, $description, $quantity, $categoryId, $full_url);
        } else {
            return $this->productObj->updateProductWithoutPhoto($productId, $name, $price, $description, $quantity, $categoryId);
        }
    }
    
    public function getAdmins() {
        return $this->userObj->getAdmins();
    }

    public function getAllUsers() 
    {
        return $this->userObj->getAllUsers();
    }
}
?>