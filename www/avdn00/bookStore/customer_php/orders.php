<?php

include '../config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>orders</h3>
        <p><a href="./home.php">home</a> / orders</p>
    </div>

    <section class="placed_orders">
        <h1 class="title">placed orders</h1>

        <div class="box-container">
            <?php
            $query = "SELECT * FROM `orders` WHERE user_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $order_query = $stmt->get_result();

            if ($order_query->num_rows > 0) {
                while ($fetch_orders = $order_query->fetch_assoc()) {
            ?>
                    <div class="box">
                        <p>Placed on: <span><?php echo htmlspecialchars($fetch_orders['placed_on']); ?></span></p>
                        <p>Name: <span><?php echo htmlspecialchars($fetch_orders['name']); ?></span></p>
                        <p>Email: <span><?php echo htmlspecialchars($fetch_orders['email']); ?></span></p>
                        <p>Address: <span><?php echo htmlspecialchars($fetch_orders['address']); ?></span></p>
                        <p>Books in the order: <span><?php echo htmlspecialchars($fetch_orders['total_products']); ?></span></p>
                        <p>Total price: <span>$<?php echo htmlspecialchars($fetch_orders['total_price']); ?>/-</span></p>
                        <p>Payment status: <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                    echo 'red';
                                                                } else {
                                                                    echo 'green';
                                                                } ?>"><?php echo htmlspecialchars($fetch_orders['payment_status']); ?></span></p>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">you have no orders yet</p>';
            }
            ?>
        </div>

    </section>




    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>