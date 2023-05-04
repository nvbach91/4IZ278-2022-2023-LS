<?php
    if (isset($_POST)) {
        require_once "db.php";

        if (!filter_var($_POST["pic"], FILTER_VALIDATE_URL)) {
            //TODO ajax
            die("Not a valid email address");
        }
        
        $query = "INSERT INTO product(product_id,name,price,img,category_name) VALUES (product_id,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1,$_POST["name"],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["price"],PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["pic"],PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["category"],PDO::PARAM_STR);
        $stmt->execute();

    }

    header("Location: index.php");



?>