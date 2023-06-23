<?php
require 'index.php';

$payLink;

if (!empty($_SESSION['user'])) {
    $payLink = 'paymentPage.php';
} elseif (!empty($_SESSION['adress'])) {
    $payLink = 'paymentPage.php';
} else {
    $payLink = 'login.php';
}

?>
<div class="cartContainer">
    <div class="productList">
        <?php
        include 'productsCart.php'; ?>
    </div>
    <div class="checkout">
        <div class="errors">
            <h2>
                <?php
                if (!empty($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </h2>
        </div>
        <div class="continueText">
            <h2><?php if (!empty($_SESSION['user'])) : ?>
                    <?php
                        $emailCheck = $usersDB->fetchByEmail($_SESSION['user']['email']);

                    if (empty($emailCheck)) {
                        if (empty($adress)) {
                            header("Location:extraInfo.php");
                        }
                    }



                    echo $_SESSION['user']['name']
                        . ',' ?><br><?php echo 'Your delievery adress: '
                                    ?>
                    <br>
                    <?php
                    if (isset($_SESSION['user']['adress']) and isset($_SESSION['user']['postalCode'])) {
                        echo $_SESSION['user']['adress'] . ', '
                            . $_SESSION['user']['postalCode'];
                    }
                    ?>
                <?php endif;
                if (!empty($_SESSION['adress'])) :
                ?>
                    <?php
                    echo 'Your phone: +420' . $_SESSION['adress']['phone']
                    ?>
                    <br>
                    <?php
                    echo  'Your delievery adress: '
                        . $_SESSION['adress']['adress'] . ', '
                        . $_SESSION['adress']['postalCode'];
                    ?>
                <?php endif; ?>

                <h2><br>Items in your cart: <?php echo $_SESSION['cartAmount']; ?>,</h2>
                <h2>with a total price: <?php echo $_SESSION['totalCart'] ?> Kč</h2>
                <h2><br>Press "Procced to payment" to complete the payment</h2>
        </div>
        <div class="continueButton">
            <button onclick="window.location.href= '<?php echo $payLink; ?>'">
                Procced to payment
            </button>
        </div>
    </div>
</div>