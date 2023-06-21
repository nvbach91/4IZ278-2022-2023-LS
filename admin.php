<?php
require 'index.php';
require './db/OrderedDatabse.php';
// if (!empty($_SESSION['user']['admin_id'])) {
//     header("Location:cart.php");
// }


?>
<form method="post" action="">
    Type OrderID to get info: <input type="text" name="order_id">
    <input type="submit" value="Get info">
</form>
    <form method="post" action="./complete.php">
                Type OrderID to compelte it: <input type="text" name="order_id">
                <input type="submit" value="Complete">
            </form>
            <a href="./updateProd.php"><h2>Update product</h2></a>
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
                    echo nl2br($orderInfoProd['product_name'] . "-" . $orderInfoProd['amount'] . "\n");
                } ?>
            </h2>
           
        </div>

    </div>
    <?php } else echo 'No orders placed'
    // foreach ($orders as $order) {
    //     foreach ($ordereds as $ordered){
    // if($ordered['order_id']==$order['order_id']){
    //     echo 'ORDER NUMBER:' . $order['order_id'];
    //     echo '<br>';
    //     echo 'USER ID:' . $order['user_id'];
    //     echo '<br>';
    //     echo 'ORDER AMOUNT:' . $ordered['amount'];
    //     echo '<br>';
    //     echo 'ORDER TOTAL PRICE:' . $ordered['price']*$ordered['amount'];
    //     echo '<br>';
    //     echo 'PRODUCT ID:' . $ordered['product_id'];
    //     echo '<br>';
    //     foreach ($users as $user){
    //         echo 'User ADRESS:' . $user['adress'];
    //         echo '<br>'; 
    //     }
    //     echo '<br>';
    //     echo '<br>';
    // }
    ?>