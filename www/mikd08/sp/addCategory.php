<?php
//check on this again combine ajax and normal php ?? find a way

session_start();
    if (isset($_POST["category_name"])) {
        //TODO ajax errors
        if($_POST["category_name"] == ""){
            $_SESSION["error"] = "Error: Category name cannot be empty.";
            header("Location: index.php");
            die;
        } 
        // END TODO
        require_once "db.php";
        
        try {
            $query = "INSERT INTO category(category_name) VALUES (?)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1,$_POST["category_name"],PDO::PARAM_STR);
            $stmt->execute();
        } catch (\Throwable $th) {
            $_SESSION["error"] = $stmt->errorInfo()["2"];
        }


    }

    header("Location: index.php");

