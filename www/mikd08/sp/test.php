<?php
header("Content-type: application/json");
session_start();
require_once __DIR__."/db.php";
try {
    $query = "UPDATE `product` SET name=?, price=?, img=?, category_name=?, last_update=? WHERE product_id=?";
$stmt = PDO->prepare($query);
$stmt->bindValue(1, "Apple MacBook Air M1", PDO::PARAM_STR);
$stmt->bindValue(2, 22898, PDO::PARAM_INT);
$stmt->bindValue(3, "https://media.istockphoto.com/id/178716575/photo/mobile-devices.jpg?s=612x612&w=0&k=20&c=9YyINgAbcmjfY_HZe-i8FrLUS43-qZh6Sx6raIc_9vQ=", PDO::PARAM_STR);
$stmt->bindValue(4, "dfghdfhg", PDO::PARAM_STR);
$stmt->bindValue(6, 1, PDO::PARAM_INT);
$stmt->bindValue(5, time(), PDO::PARAM_STR);
$stmt->execute();
} catch (\Throwable $th) {
    var_dump($stmt->errorInfo());

}


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

