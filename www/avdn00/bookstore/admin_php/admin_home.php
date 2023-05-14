<?php

include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:./login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin board</title>
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>

    <div class="window">
        <div class="logo-container">
            <div class="logo">
                <p><img alt="logo" src="../img/open-book.png"></p>
            </div>
        </div>
        <section class='dashboard'>

            <h1 class='title'>Dashboard</h1>

            <div class='box-container'>

                <div class="box">
                    <?php
                    $total_pendings = 0;
                    $query = "SELECT total_price FROM `orders` WHERE payment_status = 'pending'";
                    $select_pending = mysqli_query($connection, $query) or die('query failed');
                    if (mysqli_num_rows($select_pending) > 0) {
                        while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                            $total_price = $fetch_pendings['total_price'];
                            $total_pendings += $total_price;
                        };
                    };
                    ?>
                    <h3><?php echo $total_pendings ?></h3>
                    <p>Total pendings</p>
                </div>

                <div class='box'>
                    <?php
                    $total_completed = 0;
                    $query = "SELECT total_price FROM `orders` WHERE payment_status = 'completed'";
                    $select_completed = mysqli_query($connection, $query) or die('query failed');
                    if (mysqli_num_rows($select_completed) > 0) {
                        while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                            $total_price = $fetch_completed['total_price'];
                            $total_completed += $total_price;
                        };
                    };
                    ?>
                    <h3><?php echo $total_completed ?></h3>
                    <p>Completed payments</p>
                </div>

                <div class='box'>
                    <?php
                    $query = "SELECT * FROM `orders`";
                    $select_orders = mysqli_query($connection, $query) or die('query failed');
                    $number_of_orders = mysqli_num_rows($select_orders);
                    ?>
                    <h3><?php echo $number_of_orders ?></h3>
                    <p>Orders placed</p>
                </div>

                <div class='box'>
                    <?php
                    $query = "SELECT * FROM `products`";
                    $select_products = mysqli_query($connection, $query) or die('query failed');
                    $number_of_products = mysqli_num_rows($select_products);
                    ?>
                    <h3><?php echo $number_of_products ?></h3>
                    <p>Products added</p>
                </div>

                <div class='box'>
                    <?php
                    $query = "SELECT * FROM `users` WHERE user_type = 'user'";
                    $select_users = mysqli_query($connection, $query) or die('query failed');
                    $number_of_users = mysqli_num_rows($select_users);
                    ?>
                    <h3><?php echo $number_of_users ?></h3>
                    <p>Users</p>
                </div>

                <div class='box'>
                    <?php
                    $query = "SELECT * FROM `message`";
                    $select_messages = mysqli_query($connection, $query) or die('query failed');
                    $number_of_messages = mysqli_num_rows($select_messages);
                    ?>
                    <h3><?php echo $number_of_messages ?></h3>
                    <p>New messages</p>
                </div>
            </div>

        </section>
    </div>


    <script src="../js/admin_script.js"></script>
</body>

</html>