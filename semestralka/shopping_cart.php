<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles/cart_style.css">
    
</head>
<body>
    <div class="container">
        <a class="back-button" href="index.php">Back</a>
        <h1>Shopping Cart</h1>

        <div class="cart-container">
            <div class="cart-products">
                <?php
                session_start();

                if (!isset($_SESSION['shopping_cart']) || empty($_SESSION['shopping_cart'])) {
                    echo 'Your shopping cart is empty.';
                } else {
                    foreach ($_SESSION['shopping_cart'] as $cartItem) {
                        echo '<div class="cart-product">';
                        echo '<h2>' . $cartItem['product_name'] . '</h2>';
                        echo '<p>Price: $' . $cartItem['price'] . '</p>';
                        echo '<p>Quantity: ' . $cartItem['quantity'] . '</p>';
                        echo '<p>Total: $' . ($cartItem['price'] * $cartItem['quantity']) . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div class="cart-buttons">
                <a href="payment.php" class="proceed-button">Proceed to Payment</a>
            </div>
        </div>
    </div>
</body>
</html>

