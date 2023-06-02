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
    $placed_on = date('d-M-Y');

    if ($name == '') {
        $message[] = 'name is empty';
    }
    if ($email == '') {
        $message[] = 'email is empty';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'email is not valid';
    }

    if ($number == '') {
        $message[] = 'number is empty';
    } else if (strlen($number) != 9) {
        $message[] = 'number does not have 9 numbers';
    }

    if ($address == '') {
        $message[] = 'address is empty';
    }


    $cart_total = 0;
    $cart_products[] = '';

    $query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
    $cart_guery = mysqli_query($connection, $query) or die('query failed');
    if (mysqli_num_rows($cart_guery) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_guery)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $query = "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' 
    AND email = '$email' AND payment_method = '$method' AND address ='$address'
    AND total_products = '$total_products'  AND total_price = '$cart_total'";
    $order_guery = mysqli_query($connection, $query) or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty';
    } else {
        if (mysqli_num_rows($order_guery) > 0) {
            $message[] = 'order already placed';
        } else if (empty($message)) {
            $query = "INSERT INTO `orders`(user_id,name,number,email,payment_method,address,total_products,total_price,placed_on)
            VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')";
            mysqli_query($connection, $query) or die('query failed');
            $message[] = 'order was placed successfully';
            mysqli_query($connection, "DELETE FROM `cart` WHERE user_id='$user_id'") or die('query failed');
        } else  $message[] = 'order was not finished';
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
        $query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
        $select_cart = mysqli_query($connection, $query) or die('query failed');

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
                <div class="inputBox">
                    <span>your email:</span>
                    <input type="email" name="email" required placeholder="enter your email">
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