<?php
    if (isset($_GET["order_id"])) {
        session_start();
        require_once "db.php";

        $query = "SELECT 
        `order`.order_id, `order`.price order_price, `order`.date, `order`.payment_method, `order_item`.amount, `order_item`.price order_product_price, `product`.name, `product`.price product_price, `product`.img, `product`.category_name 
        FROM `order`
        JOIN order_item ON `order`.order_id = `order_item`.`order_id` 
        JOIN product ON `product`.`product_id`= `order_item`.`product_id`
        WHERE `order`.order_id=? AND `order`.user_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1,$_GET["order_id"],PDO::PARAM_INT);
        $stmt->bindValue(2,$_SESSION["user_id"],PDO::PARAM_INT);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll();
        if (empty($orderDetails)) {
            http_response_code(400);
            $_SESSION["error"] = "Order does not exist";
        } else {
            http_response_code(200);
            echo json_encode($orderDetails);
        }
    }
?>