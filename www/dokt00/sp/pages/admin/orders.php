<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/UsersDB.php';
require_once '../../db/OrderDB.php';
require_once '../../db/OrderitemDB.php';

$userDB = new UsersDB();
$orderDB = new OrderDB();
$orderitemDB = new OrderitemDB();

$users = $userDB->getNonAdminUsers(); 

foreach ($users as $user) : ?>

    <div class="user-box">
        <h3>User: <?= htmlspecialchars($user['username']); ?></h3>

        <?php
        $orders = $orderDB->getOrdersByUserId($user['user_id']);
        if (empty($orders)) : ?>
            <p>This user has no orders.</p>
        <?php else :
            $orderNumber = 1;

            foreach ($orders as $order) : ?>

                <div class="order-box">
                    <h3>Order <?= $orderNumber; ?></h3>
                    <h4>Order Date: <?= (new DateTime($order['date']))->format('j.n.Y H:i'); ?></h4>

                    <?php $orderProducts = $orderDB->getProductsByOrderId($order['order_id']); ?>

                    <div class="product-box">
                        <table>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>

                            <?php foreach ($orderProducts as $product) : ?>

                                <tr>
                                    <td><img src="../../<?= htmlspecialchars($product['image_url']); ?>" alt="" width="100"><span class="product-name"><?= htmlspecialchars($product['name']); ?></span></td>
                                    <td><span class="product-quantity"><?= htmlspecialchars($product['quantity']); ?> ks</span></td>
                                    <td><span class="product-price"><?= htmlspecialchars($product['price']); ?> CZK</span></td>
                                </tr>

                            <?php endforeach; ?>

                        </table>
                        <span class="total-price">Total price: <?= $orderitemDB->getTotalPriceByOrderId($order['order_id']); ?> CZK</span>
                    </div>  
                </div> 

                <?php $orderNumber++; ?>

            <?php endforeach; ?>
        <?php endif; ?>
    </div> 

<?php endforeach; ?>
