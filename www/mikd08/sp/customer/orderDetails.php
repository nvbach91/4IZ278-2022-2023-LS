<?php
    if (isset($_GET["order_id"])) {
        session_start();
        require_once __DIR__."/../db.php";

        $query = "SELECT 
        `order`.order_id, `order`.price order_price, `order`.date, `order`.payment_method, `order_item`.amount, `order_item`.price order_product_price, `product`.name, `product`.price product_price, `product`.img, `product`.category_name 
        FROM `order`
        JOIN order_item ON `order`.order_id = `order_item`.`order_id` 
        JOIN product ON `product`.`product_id`= `order_item`.`product_id`
        WHERE `order`.order_id=? AND `order`.user_id=?";
        $orderDetails = customFetch($query, [$_GET["order_id"] => PDO::PARAM_INT, $_SESSION["user_id"] => PDO::PARAM_INT]);

        if (empty($orderDetails)) {
            http_response_code(400);
            $_SESSION["error"] = "Order does not exist";
        } else {
            echo json_encode($orderDetails);
        }
    }
?>