<?php 
    session_start();
    require_once "./database/ItemsDatabase.php";

    $itemDB = new ItemsDatabase();

    if(!isset($_COOKIE["username"])){
        header("Location: ./login.php");
        exit;
    }
    $idList=[];
    if(isset($_SESSION["cart"])){
        $idList=$_SESSION["cart"];
    }
    $cart = [];
    foreach($idList as $id){
        array_push($cart, $itemDB->fetch($id));
    }

    function countItemOccurencesInCart($id) {
        $idList=$_SESSION["cart"];
        $counts = array_count_values($idList);
        return $counts[$id];
    }

    $itemsInCart=[];
    $totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Checkout</title>
</head>
<body>
    <header>
        <?php include "./includes/logo.php" ?>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./orderhistory.php">Order history</a></li>
                <?php
                if(isset($_SESSION["cart"])){
                    $itemsNumber = count($_SESSION["cart"]);
                }
                else{
                    $itemsNumber = 0;
                }
                ?>
                <li><a href="./checkout.php">Checkout(<?php echo $itemsNumber;?>)</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="cart">
	<?php if($cart!=[]): ?>
            <div id="cart-items-section">
                <?php foreach($cart as $item):?>
                    <?php $totalPrice = $totalPrice + $item["price"];?>
                    <?php if(!in_array($item["itemid"],$itemsInCart)):?>
                        <div class="cart-item">
                            <p><strong><?php echo $item["name"];?></strong></p>
                            <div class="item-quantity">
                                <p><?php echo countItemOccurencesInCart($item["itemid"]);?></p>
                                <a href="./changeItemQuantity.php?type=add&id=<?php echo $item["itemid"]; ?>">+</a>
                                <a href="./changeItemQuantity.php?type=remove&id=<?php echo $item["itemid"]; ?>">-</a>
                            </div>
                            <p><a href="./removeItemCart.php?item_id=<?php echo $item["itemid"];?>">Remove</a></p>
                            <p>$<?php echo $item["price"]*countItemOccurencesInCart($item["itemid"]);?></p>
                        </div>
                        <?php array_push($itemsInCart,$item["itemid"]);?>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <div id="shipment-payment-section">
                <form action="./createOrder.php" method="POST" id="checkoutForm">
                    <label>Shipping type:</label>
                    <select name="shipping">
                        <option value="DPD">DPD</option>
                        <option value="DPL">DPL</option>
                        <option value="Česká pošta">Česká pošta</option>
                    </select>
                    <label>Payment type:</label>
                    <select name="payment">
                        <option value="Cash">Cash</option>
                        <option value="Bank account transfer">Bank account transfer</option>
                        <option value="Credit card">Credit card</option>
                    </select>
                    <p><strong>Total: $<?php echo $totalPrice; ?></strong></p>
                    <button type="submit">Order</button>
                </form>
            </div>
	<?php endif; ?>
        </div>
    </main>
    <?php include "./includes/footer.php" ?>
</body>
</html>