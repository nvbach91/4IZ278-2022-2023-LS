<?php 
    session_start();
    if (count($_SESSION["cart"]) > 0) {

        require_once __DIR__."/../db.php";
        require_once __DIR__."/../funcs.php";
    
        $query = "INSERT INTO `order` (price,date,payment_method,user_id) VALUES (?,NOW(),'cash',?)";
        $params = [totalPrice($_SESSION["cart"]) => PDO::PARAM_INT, $_SESSION["user_id"] => PDO::PARAM_INT];
        sql($query,$params);
        $newOrderId = PDO->lastInsertId();
        
        $query = "INSERT INTO order_item(amount,price,order_id,product_id) VALUES(?,?,?,?)";
        $stmt = PDO->prepare($query);
        $stmt->bindValue(3,$newOrderId,PDO::PARAM_INT);
        foreach ($_SESSION["cart"] as $product_id => $data) {
            $stmt->bindValue(1,$data["amount"],PDO::PARAM_INT);
            $stmt->bindValue(2,$data["amount"]*$data["price"],PDO::PARAM_INT);
            $stmt->bindValue(4,$product_id,PDO::PARAM_INT);
            $stmt->execute();
        }
        $_SESSION["cart"] = [];
        $_SESSION["ordered"] = "Thank you for your order \^o^/";
        
        $userEmail = customFetch("SELECT email FROM user WHERE user_id=?", [$_SESSION["user_id"] => PDO::PARAM_INT],false)["email"];
        $headers = [
        'MIME-Version' => '1.0',
        'Content-type' => 'text/html; charset=utf-8',
        'From' => 'mikd08@vse.cz',
        'Reply-To' => 'mikd08@vse.cz',
        ];
        
        mail($userEmail,"Order","Thank you for your order :)",$headers);
    }
    header("Location: /www/mikd08/sp/cart.php");

?>