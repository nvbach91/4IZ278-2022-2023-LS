<?php 
    require_once "db.php";
    if(isset($_GET["edit"])){
        

        $query = "SELECT * FROM `product` WHERE product_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $_GET["edit"], PDO::PARAM_INT);
        $stmt->execute();
        $editProduct = $stmt->fetch();
        echo json_encode($editProduct);
        exit;
    }

    if (isset($_POST)) {

        if (!filter_var($_POST["img"], FILTER_VALIDATE_URL)) {
            die("Image URL not valid");
        }

        $query = "UPDATE `product` SET name=?, price=?, img=?, category_name=? WHERE product_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $_POST["name"], PDO::PARAM_STR);
        $stmt->bindValue(2, $_POST["price"], PDO::PARAM_INT);
        $stmt->bindValue(3, $_POST["img"], PDO::PARAM_STR);
        $stmt->bindValue(4, $_POST["category"], PDO::PARAM_STR);
        $stmt->bindValue(5, $_POST["product_id"], PDO::PARAM_INT);
        $stmt->execute();

        header("Location: index.php");
    }

?>