<?php

include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:./login.php');
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    $query = "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'";
    mysqli_query($connection, $query) or die('query failed');
    $message[] = 'Payment status has been updated';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $query = "DELETE FROM `orders` WHERE id = '$delete_id'";
    mysqli_query($connection, $query) or die('query failed');
    header('location:admin_orders.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
        <section class="orders">
            <h1 class="title">Placed orders</h1>

            <div class="box-container">
                <?php
                $query = "SELECT * FROM `orders`";
                $select_orders = mysqli_query($connection, $query) or die('query failed');
                if (mysqli_num_rows($select_orders) > 0) {
                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                ?>
                        <div class="box">
                            <p>user id: <span><?php echo $fetch_orders['user_id']; ?></span></p>
                            <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                            <p>name: <span><?php echo $fetch_orders['name']; ?></span></p>
                            <p>number: <span><?php echo $fetch_orders['number']; ?></span></p>
                            <p>email: <span><?php echo $fetch_orders['email']; ?></span></p>
                            <p>address: <span><?php echo $fetch_orders['address']; ?></span></p>
                            <p>total products: <span><?php echo $fetch_orders['total_products']; ?></span></p>
                            <p>total price: <span>$<?php echo $fetch_orders['total_price']; ?>/-</span></p>
                            <p>payment method: <span><?php echo $fetch_orders['payment_method']; ?></span></p>
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                                <select name="update_payment">
                                    <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                                    <option value="pending">pending</option>
                                    <option value="completed">completed</option>
                                </select>
                                <input type="submit" value="update" name="update_order" class="option-button">
                                <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?')" class="delete-button">Delete</a>
                                <a href="admin_orders.php?details=<?php echo htmlspecialchars($fetch_orders['id']); ?>" class="button">Details</a>
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">No placed orders yet</p>';
                }

                ?>
            </div>


        </section>

        <section class="details-form">
            <div class="box-container">
                <?php
                if (isset($_GET['details'])) {
                    $update_id = $_GET['details'];
                    $query = "SELECT * FROM `orders` WHERE id = ?";
                    $stmt = mysqli_prepare($connection, $query);
                    mysqli_stmt_bind_param($stmt, "i", $update_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        while ($fetch_details = mysqli_fetch_assoc($result)) {
                ?>
                            <div class="box">

                                <form action="" method="post" enctype="multipart/form-data">
                                    <h3 class="title">Order details</h3>
                                    <?php

                                    $books = $fetch_details['total_products'];
                                    $array = explode(",", $books);

                                    foreach ($array as $book) {
                                        $name = trim($book);
                                        $parts = explode("(", $book);
                                        $title = trim($parts[0]);
                                        $number = rtrim($parts[1], ")");
                                        echo "<div class='book'>" . "Book name: " . $title . "<br>" . "</div>";
                                        echo "<div class='book'>" . "Quantity: " . $number . "<br>" . "</div>";

                                        $query = "SELECT * FROM `products` WHERE name = ?";
                                        $stmt = mysqli_prepare($connection, $query);
                                        mysqli_stmt_bind_param($stmt, "s", $title);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $price = $row['price'];
                                            echo "<div class='book'>" . "Price: " . $price . "<br>" . "</div>";
                                        }
                                    }
                                    ?>
                                    <div class="price">Total: $<?php echo htmlspecialchars($fetch_details['total_price']); ?>/-</div>

                                    <a href="../admin_php/admin_orders.php" class="option-button">Close</a>
                                </form>
                            </div>

                <?php
                        }
                    }
                } else {
                    echo ' <script>
                document.querySelector(".details-form").style.display = "none"
            </script>';
                }
                ?>
            </div>
        </section>
    </div>


    <script src="../js/admin_script.js"></script>
</body>

</html>