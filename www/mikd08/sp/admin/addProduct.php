<?php
    require_once __DIR__."/../funcs.php";
    session_start();
    if (isset($_POST["token"])) {
        checkTokenAsync($_POST["token"]);
    } else {
        http_response_code(400);
        die(json_encode("Error: Invalid token"));
    }

    if (isset($_POST)) {
        $errors = [];
        if (!filter_var($_POST["img"], FILTER_VALIDATE_URL) || $_POST["img"] == "") {
            array_push($errors, "Not a valid image URL address");
        }
        if ($_POST["name"] == "") {
            array_push($errors, "Name is empty");
        }
        if ($_POST["category"] == "") {
            array_push($errors, "Category is empty");
        }
        if ($_POST["price"] == "") {
            array_push($errors, "Price is empty");
        }
    
        if (empty($errors)) {
            require_once __DIR__."/../db.php";
            $params = [$_POST["name"]=>PDO::PARAM_STR,$_POST["price"]=>PDO::PARAM_INT,$_POST["img"]=>PDO::PARAM_STR,$_POST["category"]=>PDO::PARAM_STR];
            sql("INSERT INTO product(name,price,img,category_name) VALUES (?,?,?,?)",$params);
        } else {
            http_response_code(400);
            die(json_encode($errors));
        }
    }
?>