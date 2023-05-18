<?php 
    session_start();
    require_once "db.php";

    if(isset($_GET["edit"]) && empty($_POST)){
        
        $query = "SELECT * FROM `product` WHERE product_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $_GET["edit"], PDO::PARAM_INT);
        $stmt->execute();
        $editProduct = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["last_update"] = $editProduct["last_update"];
        echo json_encode($editProduct);
        exit;
    }

    if (!empty($_POST)) {
        //TODO errors ajax
        // if (!filter_var($_POST["img"], FILTER_VALIDATE_URL)) {
        //     die("Image URL not valid");
        // }
        $statement = $pdo->prepare("SELECT last_update FROM product WHERE product_id = ?");
        $statement->bindValue(1, $_POST["product_id"], PDO::PARAM_INT);
        $statement->execute();
        $last_update_verify = $statement->fetch(PDO::FETCH_ASSOC)["last_update"];


        if ($last_update_verify == $_SESSION["last_update"]) {
            $currTime = date('Y-m-d H:i:s', time());
            var_dump($currTime);

            $query = "UPDATE `product` SET name=?, price=?, img=?, category_name=?, last_update=? WHERE product_id=?";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $_POST["name"], PDO::PARAM_STR);
            $stmt->bindValue(2, $_POST["price"], PDO::PARAM_INT);
            $stmt->bindValue(3, $_POST["img"], PDO::PARAM_STR);
            $stmt->bindValue(4, $_POST["category"], PDO::PARAM_STR);
            $stmt->bindValue(6, $_POST["product_id"], PDO::PARAM_INT);
            $stmt->bindValue(5, $currTime, PDO::PARAM_STR);
            $stmt->execute();

            unset($_SESSION["last_update"]);

            header("Location: index.php");
            exit;
        } else {
            $_SESSION["error"] = "Error: Your changes were not uploaded because the product was modified";
        
            // $_SESSION["name"] = $_POST['name'];
            // $_SESSION["price"] = $_POST['price'];
            // $_SESSION["img"] = $_POST['img'];
            // $_SESSION["category"] = $_POST['category'];
            // $_SESSION["product_id"] = $_POST['product_id'];
            

            header("Location: index.php");
            exit;
            //TODO autofill dokument 
            // fix reopen edit form
        }
    }
?>