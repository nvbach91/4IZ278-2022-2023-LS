<?php
class Products{

    public function showProducts()
    {
        $database = new Database();
        $query = "SELECT * FROM products WHERE status='in stock' OR status ='out of stock'";
        $products = $database->queryGet($query,array());
        return $products; 

    }
    public function showSomeProducts($from,$limit)
    {
        $database = new Database();
        $query = "SELECT * FROM `products` WHERE `product_id` >= ? AND `product_id` < ?";
        $params = array($from,$from+$limit);
        $products = $database->queryGet($query,$params);
        return $products; 
    }
    public function getProductAmount(){
        $database = new Database();
        $query = "SELECT COUNT(product_id) FROM `products`";
        $result = $database->queryGet($query, array());
        $amount = $result[0]["COUNT(product_id)"];
        return $amount; 
    }

}

?>