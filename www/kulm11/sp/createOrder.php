<?php
    require_once "./database/ItemsDatabase.php";
    require_once "./database/UsersDatabase.php";
    require_once "./database/OrdersDatabase.php";

    session_start();

    $itemsDB = new ItemsDatabase();
    $usersDB = new UsersDatabase();
    $ordersDB = new OrdersDatabase();

    if(!isset($_SESSION["cart"])){
        header("Location: ./index.php");
        exit;
    }

    if(!isset($_COOKIE["username"])){
        header("Location: ./login.php");
        exit;
    }

    if(!isset($_POST)){
        header("Location: ./index.php");
        exit;
    }
    $user = $usersDB->getUserViaEmail($_COOKIE["username"]);

    if(array_key_exists('confirmButton', $_POST)){
        $itemsIDs = $_SESSION["cart"];
        $totalprice = 0;
        foreach($itemsIDs as $itemID){
            $item = $itemsDB->fetch($itemID);
            $totalprice = $totalprice + $item["price"];
        }

        $ordersDB->createOrder(date("Y-m-d"), $totalprice, $user["userid"], htmlspecialchars($_POST["shipping"]), htmlspecialchars($_POST["payment"]));
        $orderID = $ordersDB->getLastID();

        $quantities = array_count_values($itemsIDs);
        
        foreach(array_unique($itemsIDs) as $temp){
            $quantity=$quantities[$temp];
            $itemsPrice=$quantity*$itemsDB->fetch($temp)["price"];
            $item = $itemsDB->fetch($temp);
            $ordersDB->createOrderItem($quantity,$itemsPrice,$orderID,$temp,$item["name"]);
        }

        $subject = "Confirmation of your Store Trek order";
        $message = "Thank you for your Store Trek order! For more information checkout your order history page.";
        $header = ["MIME-Version"=>"1.0","Content-type"=>"text/html;charset=UTF-8","From" => "kulm11@vse.cz", "Reply-To" => "kulm11@vse.cz"];
        mail($_COOKIE["username"], $subject, $message, $header);

        $_SESSION["cart"]=[];
        header("Location: ./orderhistory.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Confirm order</title>
</head>

<body>
    <header>
        <?php include "./includes/logo.php" ?>
    </header>
    <main id="confirmation">
        <h2><strong>Is this your adress?</strong></h2>
        <p><strong>First name</strong>: <?php echo $user["firstname"]; ?></p>
        <p><strong>Last name</strong>: <?php echo $user["lastname"]; ?></p>
        <p><strong>City</strong>: <?php echo $user["city"]; ?></p>
        <p><strong>Street</strong>: <?php echo $user["street"]; ?></p>
        <p><strong>Building number</strong>: <?php echo $user["buildingno"]; ?></p>
        <p><strong>Zip code</strong>: <?php echo $user["zipcode"]; ?></p>
        <form action="./createOrder.php" method="POST" id="checkoutForm">
            <input type="text" name="shipping" value="<?php echo $_POST["shipping"];?>" hidden>
            <input type="text" name="payment" value="<?php echo $_POST["payment"];?>" hidden>
            <a href="./checkout.php">Cancel</a>
            <button type="submit" value="Confirm" name="confirmButton">Confirm</button>
        </form>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>