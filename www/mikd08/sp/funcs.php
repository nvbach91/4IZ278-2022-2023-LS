<?php 
    function totalPrice($cart) {
        $total = 0;
        foreach ($cart as $data) {
            $total += $data['price'] * $data["amount"];
        }
        return $total;
    };    



?>