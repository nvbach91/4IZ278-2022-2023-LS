<?php require 'index.php';
if (empty($_SESSION['cart_list'])) {
    $_SESSION['message'] = 'You cart is empty!';
    header("Location: cart.php");
    die;
}
?>
<section>
    <div class="errors">
    <?php 
            if (!empty($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <div class="form-box">
        <div class="form-value">
            <form action="sendOrder.php" method="post">
                <h2>Payment</h2>
                <div class="inputbox">
<input id="ccn" type="tel" inputmode="numeric"pattern="[0-9\s]{13,19}"
 autocomplete="cc-number" maxlength="16" minlength="16" name ="ccn" placeholder="">
                    <ion-icon name="mail-outline"></ion-icon>
                    <label for="ccn">Credit Card Number</label>
                </div>
                <button type="submit">Pay <?php echo $_SESSION['totalCart'].' Kč' ?></button>
                <div class="register">
                    <a href="cart.php">Want to change order? Go to cart</a>
                </div>
            </form>
        </div>
    </div>
</section>