<?php
require_once "./database/OrdersDatabase.php";
require_once "./database/ItemsDatabase.php";
require_once "./database/UsersDatabase.php";

$ordersDB = new OrdersDatabase();
$itemsDB = new ItemsDatabase();
$usersDB = new UsersDatabase();

session_start();

if (!isset($_COOKIE["username"])) {
    header("Location: ./login.php");
    exit;
}
$username = $_COOKIE["username"];
$userID = $usersDB->getUserViaEmail($username)["userid"];
$orders = $ordersDB->getUsersOrders($userID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Order history</title>
</head>

<body>
    <header>
        <?php include "./includes/logo.php" ?>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./orderhistory.php">Order history</a></li>
                <?php
                if (isset($_SESSION["cart"])) {
                    $itemsNumber = count($_SESSION["cart"]);
                } else {
                    $itemsNumber = 0;
                }
                ?>
                <li><a href="./checkout.php">Checkout(<?php echo $itemsNumber; ?>)</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="order-history">
            <h2>Order history</h2>
            <?php foreach ($orders as $order) : ?>
                <div class="order"></div>
                <h3>Order #<?php echo $order["orderid"] ?></h3>
                <?php $orderedItems = $ordersDB->getOrderedItems($order["orderid"]); ?>
                <?php $totalPrice = 0; ?>
                <table class="ordered-items">
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php foreach ($orderedItems as $orderedItem) : ?>
                        <?php $item = $itemsDB->fetch($orderedItem["item_itemid"]); ?>
                        <tr>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo $orderedItem["quantity"]; ?></td>
                            <td>$<?php echo $orderedItem["price"]; ?></td>
                            <?php $totalPrice = $totalPrice + $orderedItem["price"]; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>Shipping: <?php echo $order["shipping"]; ?></td>
                        <td>1</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Payment type: <?php echo $order["paymenttype"]; ?></td>
                        <td>1</td>
                        <td>0</td>
                    </tr>
                </table>
                <p class="total-price"><strong>Total: <?php echo $totalPrice; ?></strong></p>
        </div>
    <?php endforeach; ?>
    </div>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>