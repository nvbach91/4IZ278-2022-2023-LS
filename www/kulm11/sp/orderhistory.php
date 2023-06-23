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

$totalItemAmounts = $ordersDB->getUsersOrdersAmount($usersDB->getUserViaEmail($username)["userid"]);
$itemsPerPage = 3;
$paginationCount = ceil($totalItemAmounts / $itemsPerPage);

if (!empty($_GET)) {
    $offset = htmlspecialchars($_GET["offset"]);
} else {
    $offset = 0;
}
$orders = $ordersDB->fetchPage($userID, $itemsPerPage, $offset);
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
    <ul id="homepage-pagination">
            <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
                <li>
                    <a href="<?php echo './orderhistory.php?offset=' . $i * $itemsPerPage; ?>">
                        <?php echo $i + 1; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
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
                        <tr>
                            <td><a <?php if($itemsDB->containsItem($orderedItem["item_itemid"]))echo "href='./product.php?id=". $orderedItem["item_itemid"] ."'"; ?>><?php echo $orderedItem["itemname"]; ?></a></td>
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
                <p class="total-price"><strong>Total: $<?php echo $totalPrice; ?></strong></p>
        </div>
    <?php endforeach; ?>
    </div>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>