<?php 
    require_once "db.php";
    session_start();

    function totalPrice($cart) {
        $total = 0;
        foreach ($cart as $data) {
            $total += $data['price'] * $data["amount"];
        }
        return $total;
    };

    $cart = [];
    $query = "SELECT product_id,name,price FROM product WHERE product_id=:product_id";
    $stmt = $pdo->prepare($query);
    if (isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $product_id) {
            $stmt->execute(["product_id" => $product_id,]);
            $product = $stmt->fetch();
            if (array_key_exists($product["name"], $cart)) {
                $cart[$product["name"]]["amount"] += 1;
            } else {
                $cart[$product["name"]]["amount"] = 1;
                $cart[$product["name"]]["price"] = $product["price"];
                $cart[$product["name"]]["id"] = $product["product_id"];
            }
        }
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "head.php"?>
</head>
<body>
    <?php require_once "nav.php"?>
    <ul class="list-group">
        <?php foreach ($cart as $product_name => $data) :?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo htmlentities($product_name) ?>
                <span class="badge badge-primary badge-pill"><?php echo htmlentities($data["price"])?>Kč</span>
                <span class="badge badge-primary badge-pill"><?php echo htmlentities($data["amount"]) ?></span>
                <span class="badge badge-primary badge-pill"><?php echo htmlentities($data["amount"] * htmlentities($data["price"])) ?>Kč</span>
                <span ><a href="remove.php?good_id=<?php echo htmlentities($data["id"]) ?>">X</a></span>
            </li>
        <?php endforeach ?>
    </ul>
    <?php if(count($cart) != 0): ?>
        <p id="total">Total: <?php echo totalPrice($cart)?>Kč</p>
        <div id="order-btn">
            <a href="order.php">Order</a>
        </div>
    <?php endif ?>
