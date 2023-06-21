<?php require_once 'index.php';
if (!isset($_SESSION)) {
    session_start();
};
?>
<div class="header">
    <div class="title">
        <a href="./aboutus.php"> <img src="./images/logoWOBackground.png" alt="logo"></a>
        <a href="./aboutus.php">Grow Republic</a>
    </div>
    <div class="aboutUs">
        <a href="./aboutus.php">About us</a>
    </div>
    <div class="ourProducts">
        <a href="./ourProducts.php">Our Products</a>
    </div>
    <div class="contacts">
        <a href="./ourProducts.php?category_id=2">babyleaf </a>
        <a href="./ourProducts.php?category_id=1">microgreens</a>
    </div>
    <div class="cart">
        <a href="./cart.php">
            <span id="productsAmount">
                <?php if (!empty($_SESSION['cartAmount'])) {
                    echo $_SESSION['cartAmount'];
                } else {
                    echo '0';
                }
                ?>
            </span><ion-icon name="cart-outline"></ion-icon>
        </a>
    </div>
    <?php if (isset($_SESSION['admin'])) : ?>
    <div class="contacts">
        <a href="./admin.php">Admin </a>
    </div>
    <?php endif ?>
</div>