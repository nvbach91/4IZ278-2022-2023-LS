<?php
    session_start();
    require_once __DIR__."/../funcs.php";

    if (isset($_POST["token"])) {
        checkToken($_POST["token"], "/www/mikd08/sp/index.php");
    } else {
        header("Location: /www/mikd08/sp/index.php");
        $_SESSION["error"] = "Error: Invalid token :)";
        die;
    }
    
    if (!empty($_POST)) {
        require_once __DIR__."/../db.php";

        $result = sql("DELETE FROM category WHERE category_name=?",[$_POST["category_name"]=>PDO::PARAM_STR], "Error: Category has products");
        if (boolval($result)) {
            $_SESSION["error"] = $result;
        } else {
            $_SESSION["success"] = "Category deleted";
        }
        header("Location: /www/mikd08/sp/index.php");
    }


?>

