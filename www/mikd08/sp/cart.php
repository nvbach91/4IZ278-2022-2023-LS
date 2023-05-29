<?php 
    session_start();
    if ($_SESSION["isAdmin"] == "true" | empty($_SESSION["user_id"])) {
        header("Location: /www/mikd08/sp/index.php");
        exit;
    }

    require_once __DIR__."/db.php";
    require_once __DIR__."/funcs.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "head.php"?>
</head>
<body>
    <?php require_once "nav.php"?>
    <?php if(isset($_SESSION["ordered"])): ?>
        <h1><?php echo $_SESSION["ordered"]; unset($_SESSION["ordered"]); ?></h1>
    <?php elseif(empty($_SESSION["cart"])): ?>
        <h1>Go buy something o(^▽^)o</h1>
    <?php else: ?>
    <ul class="list-group">
        <?php foreach ($_SESSION["cart"] as $product_id => $data) :?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo htmlentities($data["name"]) ?>
                <span class="badge badge-primary badge-pill"><?php echo htmlentities($data["price"])?>Kč</span>
                <span class="badge badge-primary badge-pill"><?php echo htmlentities($data["amount"]) ?></span>
                <span class="badge badge-primary badge-pill"><?php echo htmlentities($data["amount"] * htmlentities($data["price"])) ?>Kč</span>
                <span ><a href="/www/mikd08/sp/customer/remove.php?product_id=<?php echo htmlentities($product_id) ?>">X</a></span>
            </li>
        <?php endforeach ?>
    </ul>
    
    <p id="total">Total: <?php echo totalPrice($_SESSION["cart"])?>Kč</p>
    <div id="order-btn">
        <a href="/www/mikd08/sp/customer/order.php">Order</a>
    </div>
    <?php endif ?>
