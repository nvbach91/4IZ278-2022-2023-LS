<?php
    session_start();
    require_once __DIR__."/../funcs.php";

    if (isset($_POST["token"])) {
        checkTokenAsync($_POST["token"]);
    } else {
        http_response_code(400);
        die(json_encode("Error: Invalid token"));
    }
    

    if (isset($_POST["category_name"])) {
        if($_POST["category_name"] == ""){
            http_response_code(400);
            die(json_encode("Error: Category name cannot be empty."));
        } 
        require_once __DIR__."/../db.php";
        
        try {
            $query = "INSERT INTO category(category_name) VALUES (?)";
            $stmt = PDO->prepare($query);
            $stmt->bindValue(1,$_POST["category_name"],PDO::PARAM_STR);
            $stmt->execute();
        } catch (\Throwable $th) {
            http_response_code(400);
            die(json_encode("Error: Category already exists."));
        }
    }

?>
