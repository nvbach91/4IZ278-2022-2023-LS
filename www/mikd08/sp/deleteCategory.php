<?php
    session_start();

    try {
        if (!empty($_POST)) {
            require_once "db.php";
            
            $query = "DELETE FROM category WHERE category_name=?";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1,$_POST["category_name"],PDO::PARAM_STR);
            $stmt->execute();
    
        }
    
        header("Location: index.php");
    } catch (\Throwable $th) {
        $_SESSION["error"] = "Error: Category has products";
        header("Location: index.php");
    }

?>