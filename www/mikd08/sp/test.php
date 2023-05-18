<?php 
    require_once "db.php";

    $query = "SELECT * FROM product WHERE product_id=5";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $product = $stmt->fetch();
        
    // $date = date("d.m.Y H:i:s", time());
    // var_dump($date);
    
    // for ($i=0; $i < 1000000; $i++) { 
    //     $date2 = date("d.m.Y H:i:s", time());
    // }

?>