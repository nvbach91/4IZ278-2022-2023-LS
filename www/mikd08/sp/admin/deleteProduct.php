<?php
    session_start();
    require_once __DIR__."/../funcs.php";

    if (isset($_POST["token"])) {
        checkToken($_POST["token"], "/www/mikd08/sp/index.php");
    } else {
        header("Location: /www/mikd08/sp/index.php");
        $_SESSION["error"] = "Error: Invalid token";
        die;
    }
   
    if (!empty($_POST['product_id'])) {
        require_once __DIR__.'/../db.php';

        $result = sql("DELETE FROM product WHERE product_id = ?", [$_POST['product_id'] => PDO::PARAM_INT], "Error: Product cannot be deleted.");
        if (boolval($result)) {
            $_SESSION["error"] = $result;
        } else {
            $_SESSION["success"] = "Category deleted";
        }
        header("Location: /www/mikd08/sp/index.php");
    }
    

?>