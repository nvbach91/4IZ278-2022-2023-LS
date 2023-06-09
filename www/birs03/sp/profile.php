<?php require_once 'OrdersDatabase.php';?>
<?php require_once 'OrderItemsDatabase.php';?>
<?php require_once 'UsersDatabase.php';?>
<?php
session_start();

$ordersDatabase = new OrdersDatabase();
$orderItemsDatabase = new OrderItemsDatabase();
$usersDatabase = new UsersDatabase();

$user = $usersDatabase->getUserById($_COOKIE['user_id']);

$orders = $ordersDatabase->fetchAll($user['user_id']);


?>
<?php require 'header.php'; ?>
    <section style="height:100%" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1>Welcome <?php echo $user['username'];?></h1>
            <h2>Your orders</h2>
            <a href="index.php">Back</a>
            <div class="row">
                <?php foreach($orders as $order):?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 product">
                        <div class="card-body">
                            <h4 class="card-title">
                            Order id: <?php echo $order['order_id'];?>
                            </h4>
                            <h5>Date: <?php echo $order['date']; ?></h5>
                            <?php $orderItems = $orderItemsDatabase->getOrderItemById($order['order_id']);?>
                            <?php foreach($orderItems as $item):?>
                                <p><?php echo $item['name']." (".$item['quantity']."x) at ".number_format($item['price'], 2), ' €'?></p>
                            <?php endforeach;?>
                            <h5>Total price: <?php echo number_format($order['amount'], 2), ' €'; ?></h5>
                        </div>
                        <div class="card-footer">
                            
                        </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            </div>
        </section>
<?php require 'footer.php'; ?>