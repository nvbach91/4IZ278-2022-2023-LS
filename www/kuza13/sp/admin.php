<?php
require 'index.php';

// if (!empty($_SESSION['user']['admin_id'])) {
//     header("Location:cart.php");
// }
$allOrders= $ordersDB->fetchAllUnique();

?>
<form method="post" action="">
    Type OrderID to get info: <input type="text" name="order_id">
    <input type="submit" value="Get info">
</form>
<form method="post" action="./complete.php">
    Type OrderID to compelte it: <input type="text" name="order_id">
    <input type="submit" value="Complete">
</form>
<a href="./updateProd.php">
    <h2>Update product</h2>
</a>
<?php if (isset($_POST['order_id'])) {
    $ordersDetails = $orderDetails->fetchByOrderID($_POST['order_id']);
    $orderInfo = $ordersDetails[0];
?>
    <div class="productBox">
        <h2><?php echo 'Order ID:' . $orderInfo['order_id'];
            ?></h2>
        <div class='productPrice'>
            <h2><?php

                foreach ($ordersDetails as $orderInfoProd) {
                    $product=$productDB->fetchById($orderInfoProd['product_id']);

                    echo nl2br($product[0]['product_name'].' '.$orderInfoProd['product_id'] . "-" . $orderInfoProd['amount'] . "\r\n");
                }
                ?>
            </h2>

        </div>

    </div>
<?php } else echo 'No orders placed';


?>
 <h2>Orders</h2>
    <table>
        <tr>
            <th>order ID</th>
         
            <th></th>
        </tr>
        <?php foreach ($allOrders as $order) : ?>
            <tr>
                <td><a href="./orderDetails.php?order_id=<?php echo $order['order_id']; ?>"><?php echo $order['order_id'].' '; ?></a></td>
         
                <td>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');" action="./complete.php">
                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        <button type="submit" name="delete_order">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
