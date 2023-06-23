<?php
require_once './db/Database.php';
require_once './db/OrdersDatabase.php';
require_once './db/OrderedDatabase.php';
require_once './db/UsersDatabase.php';
require_once './db/OrderDetails.php';
require_once './db/ProductDatabase.php';

if (isset($_GET['order_id'])) {
    $orderedDB = new OrdersDatabase();
    $ordersDB = new OrderedDatabase();
    $usersDB = new UsersDatabase();
    $orderDetailDB = new OrderDetails();
    $itemDB = new ProductDatabase();
    $orders = $ordersDB->fetchAll();
    $orderId;
    $allTotal=0;

    $orderId = $_GET['order_id'];


    $order = $ordersDB->fetchById($orderId);
    $users = $usersDB->fetchByID($order[0]['user_id']);

    $products = $orderedDB->getOrderInfo($orderId);

    foreach ($users as $user) {
        $email = $user['email'];
    }
}
?>
<h2>Order ID <?php echo $orderId . "<br>" . 'E-mail: ' . $email; ?> </h2>
<table>
    <tr>
        <th>Name</th>
        <th>Cena</th>
        <th>Amount</th>
        <th>Total</th>

    </tr>
    <?php foreach ($products as $product) {

        $items = $itemDB->fetchById($product['product_id']);
        foreach ($items as $item) {
            $name = $item['product_name'];
        }
        $price = $product['price'];
        $amount = $product['amount'];
        $total = $price * $amount;
        $allTotal += $total; ?>

        <tr>
            <td><?php echo $name; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php echo $amount; ?></td>
            <td><?php echo $total; ?></td>



        <?php } ?>
        </form>

        </tr>
        Total: <?php echo $allTotal ?>
</table>