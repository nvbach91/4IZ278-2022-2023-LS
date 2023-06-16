<?php
require_once './pdo.php';

class CartDatabase extends Database
{

    public function addToCart($product_id,$user_id,$quantity){
        $query = "INSERT INTO cart (product_id, user_id, quantity)
                  VALUES ('$product_id', '$user_id', '$quantity') ";
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute();
        return $result;
    }
}
