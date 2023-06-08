<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php
require_once './database/UsersDB.php';
require_once './database/OrdersDB.php';
require_once './database/ProductsDB.php';
$usersDB = UsersDB::getDatabase();
$ordersDB=OrdersDB::getDatabase();

//First enter and input tests
if ((!isset($_GET) || !isset($_GET['user_id'])) && isset($_COOKIE) && isset($_COOKIE['user_email'])) {
    $_GET['user_id'] = $usersDB->getUserId($_COOKIE['user_email']);
} else if (!isset($_GET) || !isset($_GET['user_id'])) {
    header('Location: index.php');
    exit;
}

//Function that returns titles of order_item records
function getOrderTitles($orderItems){
    $productsDB=ProductsDB::getDatabase();
    $orderTitles="";
    foreach($orderItems as $orderItem){
        $orderTitles.="/".$productsDB->getBook($orderItem['order_item_book_id'])['book_name']."/";
    }
    return $orderTitles;
}

//Function that returns total cost of an order
function getOrderCost($orderItems){
    $cost=0;
    foreach($orderItems as $orderItem){
        $cost+=(float)$orderItem['price'];
    }
    return $cost;
}

$orders=$ordersDB->getUsersOrders($_GET['user_id']);


?>
<div class="container">
    <h1>Profile</h1>
    <div class="past-orders">
        <h2><?php echo $usersDB->getUser($_GET['user_id'])['user_name'] ?></h2>
        <h5>Past orders</h5>
        <div class="cart-item order-legend">
            <table>
                <tbody>
                    <tr>
                        <td style="padding-right:110px;padding-left:50px;">Date</td>
                        <td>Titles of books</td>
                        <td>Cost</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php foreach($orders as $order):?>
            <div class="cart-item">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <?php echo $order['order_date']?>
                            </div>
                        </td>
                        <td>
                            <div>
                                <h5><?php $orderItems=$ordersDB->getOrderItems($order['order_id']); echo getOrderTitles($orderItems);?></h5>
                            </div>
                        </td>
                        <td>
                            <div>
                                <?php echo getOrderCost($orderItems);?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php require_once __DIR__ . '/incl/footer.php'; ?>