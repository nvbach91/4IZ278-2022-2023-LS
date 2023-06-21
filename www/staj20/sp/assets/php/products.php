<?php
class Products{

    public function showProducts()
    {
        $database = new Database();
        $query = "SELECT * FROM products WHERE status='in stock' OR status ='out of stock'";
        $products = $database->queryGet($query,array());
        return $products; 

    }

}

?>