<?php


    if (isset($_POST)) {
        require_once "db.php";
//TODO ajax errors
        // if (!filter_var($_POST["pic"], FILTER_VALIDATE_URL) || $_POST["pic"] == "") {
        //     //TODO ajax
        //     die("Error: Not a valid image URL address");
        // }
        
        $query = "INSERT INTO product(name,price,img,category_name) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1,$_POST["name"],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["price"],PDO::PARAM_INT);
        $stmt->bindValue(3,$_POST["pic"],PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["category"],PDO::PARAM_STR);
        $stmt->execute();

    }

    header("Location: index.php");

?>