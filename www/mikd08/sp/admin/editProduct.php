<?php 
    header("Content-type: application/json");

    session_start();
    require_once __DIR__."/../db.php";
    

    if(isset($_GET["edit"]) && empty($_POST)){
        $editProduct = customFetch("SELECT * FROM `product` WHERE product_id=?", [$_GET["edit"] => PDO::PARAM_INT],false);
        if ($editProduct) {
            $_SESSION["last_update"] = $editProduct["last_update"];
            exit(json_encode($editProduct));
        } else {
            http_response_code(400);
            die(json_encode("Invalid product"));
        }
    }

    if (!empty($_POST)) {
        require_once __DIR__."/../funcs.php";
        if (isset($_POST["token"])) {
            checkTokenAsync($_POST["token"]);
        } else {
            http_response_code(400);
            die(json_encode("Error: Invalid token"));
        }
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
            $last_update_verify = customFetch(
                "SELECT last_update FROM product WHERE product_id = ?", 
                [$_POST["product_id"] => PDO::PARAM_INT],
                false
                )["last_update"];
           
            if ($last_update_verify == $_SESSION["last_update"]) {
                $currTime = date('Y-m-d H:i:s', time());
                try {
                    $query = "UPDATE `product` SET name=?, price=?, img=?, category_name=?, last_update=? WHERE product_id=?";
                    $stmt = PDO->prepare($query);
                    $stmt->bindValue(1, $_POST["name"], PDO::PARAM_STR);
                    $stmt->bindValue(2, $_POST["price"], PDO::PARAM_INT);
                    $stmt->bindValue(3, $_POST["img"], PDO::PARAM_STR);
                    $stmt->bindValue(4, $_POST["category"], PDO::PARAM_STR);
                    $stmt->bindValue(6, $_POST["product_id"], PDO::PARAM_INT);
                    $stmt->bindValue(5, $currTime, PDO::PARAM_STR);
                    $stmt->execute();
                    $_SESSION["last_update"] == "";
                    exit;
                } catch (\Throwable $th) {
                    http_response_code(400);
                    array_push($errors,"Error: Nonexistent category");
                    die(json_encode($errors));
                }

            } else {
    
                http_response_code(400);
                $_SESSION["last_update"] = customFetch("SELECT last_update FROM product WHERE product_id = ?",
                [$_POST["product_id"] => PDO::PARAM_INT],
                false)["last_update"];;
                array_push($errors,"Error: Your changes were not uploaded because the product was modified");
                die(json_encode($errors));
            }
        } else {
            http_response_code(400);
            die(json_encode($errors));
        }
    }

        
?>