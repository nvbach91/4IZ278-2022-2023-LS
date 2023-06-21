<?php

class Admin {
    private $orderObj;
    private $productObj;

    public function __construct(Order $orderObj, Product $productObj) {
        $this->orderObj = $orderObj;
        $this->productObj = $productObj;
    }

    public function cancelOrder($orderId) {
        // Retrieve all order items
        $order_items = $this->orderObj->getOrderItems($orderId);

        // Process each order item
        foreach ($order_items as $item) {
            // Increase product quantity back in stock
            $this->productObj->updateQuantity($item['products_product_id'], $item['quantity']);
            
            // Delete the order item
            $this->orderObj->deleteOrderItem($item['order_items_id']);
        }

        // Delete the order
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
    // Handle the file upload
    $target_dir = "pictures/";
    $target_file = $target_dir . basename($photo["name"]);
    $full_url = 'https://esotemp.vse.cz/~adaa08/sp/' . $target_file;

    if (!move_uploaded_file($photo["tmp_name"], $target_file)) {
        throw new Exception("File upload failed");
    }

    return $this->productObj->updateProduct($productId, $name, $price, $description, $quantity, $categoryId, $full_url);
}


}

?>
