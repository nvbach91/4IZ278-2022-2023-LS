<?php 

    session_start();

    require_once "db.php";
    require_once "funcs.php";

    $query = "INSERT INTO `order` (order_id,price,date,payment_method,user_id) VALUES (order_id,?,NOW(),'cash',?)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1,totalPrice($_SESSION["cart"]),PDO::PARAM_INT);
    $stmt->bindValue(2,$_SESSION["user_id"],PDO::PARAM_INT);
    $stmt->execute();

    $newOrderId = $pdo->lastInsertId();
    
    $query = "INSERT INTO order_item(amount,price,order_id,product_id) VALUES(?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(3,$newOrderId,PDO::PARAM_INT);
    foreach ($_SESSION["cart"] as $product_id => $data) {
        $stmt->bindValue(1,$data["amount"],PDO::PARAM_INT);
        $stmt->bindValue(2,$data["amount"]*$data["price"],PDO::PARAM_INT);
        $stmt->bindValue(4,$product_id,PDO::PARAM_INT);
        $stmt->execute();
    }
    $_SESSION["cart"] = [];
    $_SESSION["ordered"] = "Thank you for your order \^o^/";
    header("Location: cart.php");
?>