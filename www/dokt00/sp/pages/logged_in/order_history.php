<?php

require_once '../../db/Database.php';
require_once '../../db/OrderDB.php';
require_once '../../db/OrderitemDB.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$orderDB = new OrderDB();
$orderitemDB = new OrderitemDB();
$orders = $orderDB->getOrdersByUserId($_SESSION['user_id']);

$orderNumber = 1;

foreach ($orders as $order) :
?>
    <div class="order-box">
        <h3>Order <?= $orderNumber; ?></h3>
        <h4>Order Date: <?= (new DateTime($order['date']))->format('j.n.Y H:i'); ?></h4>

        <?php
        $orderProducts = $orderDB->getProductsByOrderId($order['order_id']);

        ?>
        <div class="product-box">
            <table>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <?php
                foreach ($orderProducts as $product) :
                ?>
                    <tr>
                        <td><img src="../../<?= htmlspecialchars($product['image_url']); ?>" alt="" width="100"><span class="product-name"><?= htmlspecialchars($product['name']); ?></span></td>
                        <td><span class="product-quantity"><?= htmlspecialchars($product['quantity']); ?> ks</span></td>
                        <td><span class="product-price"><?= htmlspecialchars($product['price']); ?> CZK</span></td>
                    </tr>

                <?php
                endforeach;
                ?>
            </table>
            <span class="total-price">Total price: <?= $orderitemDB->getTotalPriceByOrderId($order['order_id']); ?> CZK</span>
        </div>
    </div>
<?php
    $orderNumber++;
endforeach;
?>