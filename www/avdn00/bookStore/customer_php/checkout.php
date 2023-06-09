<?php

include '../config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../login.php');
}
if (isset($_POST['order-button'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $method = mysqli_real_escape_string($connection, $_POST['method']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $placed_on = date('d-M-Y H:i:s');

    $message = array();

    if (empty($name)) {
        $message[] = 'Name is empty';
    }
    if (empty($email)) {
        $message[] = 'Email is empty';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Email is not valid';
    }
    if (empty($number)) {
        $message[] = 'Number is empty';
    } else if (strlen($number) != 9) {
        $message[] = 'Number does not have 9 digits';
    }
    if (empty($address)) {
        $message[] = 'Address is empty';
    }

    if (empty($message)) {
        $cart_total = 0;
        $cart_products = array();

        $query = "SELECT * FROM `cart` WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($cart_item = $result->fetch_assoc()) {
                $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
                $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                $cart_total += $sub_total;
            }
        }

        $total_products = implode(', ', $cart_products);

        $query = "SELECT * FROM `orders` WHERE name = ? AND number = ? 
        AND email = ? AND payment_method = ? AND address = ? AND total_products = ? AND total_price = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssssss", $name, $number, $email, $method, $address, $total_products, $cart_total);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($cart_total == 0) {
            $message[] = 'Your cart is empty';
        } else {
            if ($result->num_rows > 0) {
                $message[] = 'Order already placed';
            } else {
                $query = "INSERT INTO `orders` (user_id, name, number, email, payment_method, address, total_products, total_price, placed_on)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("sssssssss", $user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on);
                $stmt->execute();
                $message[] = 'Order was placed successfully';

                $query = "DELETE FROM `cart` WHERE user_id = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
            }
        }
    } else {
        $message[] = 'Order was not finished';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="heading">
        <h3>Checkout</h3>
        <p><a href="./home.php">home</a> / checkout</p>
    </div>

    <section class="display-order">
        <?php
        $grand_total = 0;
        $query = "SELECT * FROM `cart` WHERE user_id = ?";
        $statement = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($statement, "i", $user_id);
        mysqli_stmt_execute($statement);
        $select_cart = mysqli_stmt_get_result($statement);

        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
        ?>
                <p><?php echo htmlspecialchars($fetch_cart['name']); ?><span> (<?php echo '$' . htmlspecialchars($fetch_cart['price']) . ' x ' . htmlspecialchars($fetch_cart['quantity']) ?>)</span></p>
        <?php
            }
        } else {
            echo '<p class="empty">No products in your cart yet</p>';
        }

        mysqli_stmt_close($statement);
        ?>
        <div class="grand-total">Grand total: <span>$<?php echo htmlspecialchars($grand_total); ?>/-</span></div>
    </section>


    <section class="checkout">
        <form action="" method="post">
            <h3>place your order</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>your name:</span>
                    <input type="text" name="name" required placeholder="enter your name">
                </div>
                <div class="inputBox">
                    <span>your number:</span>
                    <input type="number" min="0" name="number" required placeholder="enter your number">
                </div>
                <?php
                $default_email = '';
                $query = "SELECT email FROM `users` WHERE id = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $default_email = $row['email'];
                }

                ?>
                <div class="inputBox">
                    <span>your email:</span>
                    <input type="email" name="email" required placeholder="enter your email" value="<?php echo $default_email; ?>">
                </div>
                <div class="inputBox">
                    <span>payment method:</span>
                    <select name="method">
                        <option value="cash on delivery">cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="paypal">paypal</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>your full address:</span>
                    <input type="text" name="address" required placeholder="e.g. nám. Winstona Churchilla 1938/4, 120 00 Praha 3-Žižkov">
                </div>
            </div>
            <input type="submit" value="order now" class="button" name="order-button">
        </form>
    </section>



    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>