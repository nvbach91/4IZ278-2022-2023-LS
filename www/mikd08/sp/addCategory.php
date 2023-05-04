<?php
    if (isset($_POST)) {
        require_once "db.php";
        
        $query = "INSERT INTO category(category_name) VALUES (?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1,$_POST["category_name"],PDO::PARAM_STR);
        $stmt->execute();

    }

    header("Location: index.php");


?>