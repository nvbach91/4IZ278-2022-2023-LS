<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="./styles/common.css">
    <link rel="stylesheet" type="text/css" href="./styles/cart.css">
</head>
<body>
    <?php
    session_start();
    require_once 'config.php';
    require_once 'header.php';

    $firstName = '';
    $lastName = '';
    $address ='';
    $city = '';
    $zipCode = '';
    $email = '';

    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }
        
        header("Location: cart.php");
        exit();
    }

    if (empty($_SESSION['cart'])) {
        ?>
        <p class='empty-cart-message'>Your cart is empty.</p>
        <?php
    } else {
        $productIds = array_keys($_SESSION['cart']);
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));

        try {
            $query = "SELECT * FROM products WHERE id IN ($placeholders)";
            $statement = $pdo->prepare($query);
            $statement->execute($productIds);
            $cartProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <h2>Cart</h2>
            <div class='cart-products'>
            <?php
            foreach ($cartProducts as $product) {
                $productId = $product['id'];
                $productName = $product['name'];
                $productPrice = $product['price'];
                $productImage = $product['image'];
                $productQuantity = $_SESSION['cart'][$productId];
            
                if ($productQuantity === 0) {
                    continue;
                }
            
                ?>
                <div class='cart-product'>
                <a href='productDetail.php?id=<?php echo $productId; ?>'><div class='product-image'><img src='<?php echo $productImage; ?>' alt='<?php echo $productName; ?>'></div></a>
                <div class='product-details'>
                <a href='productDetail.php?id=<?php echo $productId; ?>'><h3><?php echo $productName; ?></h3></a>
                <?php
                if ($productQuantity > 1) {
                    $totalProductPrice = $productPrice * $productQuantity;
                    ?>
                    <p>Total Price: <?php echo $totalProductPrice; ?></p>
                    <?php
                } else {
                    ?>
                    <p>Price: <?php echo $productPrice; ?></p>
                    <?php
                }
                ?>
                <p>Quantity:</p>
    
                <div class='quantity-buttons'>
                <form action='updateCart.php' method='post'>
                <input type='hidden' name='product_id' value='<?php echo $productId; ?>'>
            
                <button type='submit' name='decrease_quantity' class='quantity-btn' value='1'>-</button>

                <span class='quantity' style='margin-left: 5px; margin-right: 5px;'><?php echo $productQuantity; ?></span>
            
                <button type='submit' name='increase_quantity' class='quantity-btn' value='1'>+</button>
            
                </form>
                </div>
                </div>
            
                <div class='remove-button'>
                <form action='removeFromCart.php' method='post'>
                <input type='hidden' name='product_id' value='<?php echo $productId; ?>'>
                <input type='submit' value='Remove from Cart' class='btn'>
                </form>
                </div>
            
                </div>
                <?php
            }
            
            ?>
            </div>

            <h2>Shipping</h2>
            <div class='shipping-container'>
            <form action='checkout.php' method='post'>
            <?php
            try {
                $shippingQuery = "SELECT * FROM shippings";
                $shippingStatement = $pdo->prepare($shippingQuery);
                $shippingStatement->execute();
                $shippings = $shippingStatement->fetchAll(PDO::FETCH_ASSOC);

                ?>
                <label for='shipping'>Select Shipping:</label>
                <select name='selected_shipping' id='shipping'>
                <?php
                foreach ($shippings as $shipping) {
                    $shippingId = $shipping['id'];
                    $shippingName = $shipping['name'];
                    $shippingPrice = $shipping['price'];
                    ?>
                    <option value='<?php echo $shippingId; ?>'><?php echo $shippingName . ' - ' . $shippingPrice; ?></option>
                    <?php
                }
                ?>
                </select>
                <?php
            } catch (PDOException $e) {
                die("Error executing the query: " . $e->getMessage());
            }

            ?>
            </div>

            <h2>Payment</h2>
            <div class='payment-container'>
            <?php
            try {
                $paymentQuery = "SELECT * FROM payments";
                $paymentStatement = $pdo->prepare($paymentQuery);
                $paymentStatement->execute();
                $payments = $paymentStatement->fetchAll(PDO::FETCH_ASSOC);

                ?>
                <label for='payment'>Select Payment:</label>
                <select name='selected_payment' id='payment'>
                <?php
                foreach ($payments as $payment) {
                    $paymentId = $payment['id'];
                    $paymentName = $payment['name'];
                    $paymentPrice = $payment['price'];
                    ?>
                    <option value='<?php echo $paymentId; ?>'><?php echo $paymentName . ' - ' . $paymentPrice; ?></option>
                    <?php
                }
                ?>
                </select>
                <?php
            } catch (PDOException $e) {
                die("Error executing the query: " . $e->getMessage());
            }

            ?>
            </div>

            <h2>Personal Information</h2>
            <div class='checkout-container'>
            <?php

            if(isset($_SESSION['user_id'])) {
                try {
                    $query = "SELECT * FROM users WHERE id = ?";
                    $statement = $pdo->prepare($query);
                    $statement->execute([$_SESSION['user_id']]);
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    $firstName = $result['first_name'];
                    $lastName = $result['last_name'];
                    $address = $result['address'];
                    $city = $result['city'];
                    $zipCode = $result['zip'];
                    $email = $result['email'];
                } catch (PDOException $e) {
                    die("Error executing the query: " . $e->getMessage());
                }
            }
            
            ?>
            <div class='personal-info-form'>
            <form action='checkout.php' method='post'>
            <label for='first_name'>First Name:</label>
            <input type='text' name='first_name' id='first_name' maxlength='20' value='<?php echo $firstName; ?>' required>
            <label for='last_name'>Last Name:</label>
            <input type='text' name='last_name' id='last_name' maxlength='20' value='<?php echo $lastName; ?>' required>
            <label for='address'>Address:</label>
            <input type='text' name='address' id='address' maxlength='50' value='<?php echo $address; ?>' required>
            <label for='city'>City:</label>
            <input type='text' name='city' id='city' maxlength='20' value='<?php echo $city; ?>' required>
            <label for='zip_code'>ZIP Code:</label>
            <input type='text' name='zip_code' id='zip_code' pattern='[0-9]{5}' value='<?php echo $zipCode; ?>' required>
            <label for='email'>Email:</label>
            <input type='email' name='email' id='email' value='<?php echo $email; ?>' required>

            <?php
            foreach ($cartProducts as $product) {
                $productId = $product['id'];
                $productQuantity = $_SESSION['cart'][$productId];
                if ($productQuantity > 0) {
                    ?>
                    <input type='hidden' name='product[]' value='<?php echo $productId; ?>'>
                    <input type='hidden' name='quantity[]' value='<?php echo $productQuantity; ?>'>
                    <?php
                }
            }
            ?>

            <input type='submit' value='Checkout' class='btn checkout-btn'>
            </form>
            </div>
            
        <?php
        } catch (PDOException $e) {
            die("Error executing the query: " . $e->getMessage());
        }
    }
    ?>
    </body>
</html>