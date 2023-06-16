<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/OrderDB.php';
require_once '../../db/UsersDB.php';

$orderDB = new OrderDB();
$userDB = new UsersDB();

$user_id = $_SESSION['user_id'];

$cartItems = $orderDB->getPendingByUserId($user_id);

$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item["quantity"] * $item["price"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="logged_in.php">
                <img src="../../img/logo.png" alt="Tea E-Shop Logo" width="100">
            </a>
        </div>

        <div class="login">
            <div class="dropdown">
                <p>Welcome, <?php echo $_SESSION['username']; ?></p>
                <div class="dropdown-content">
                    <a href="order_history_page.php">Order history</a>
                    <a href="logout.php">Log out</a>
                    <a href="profile.php">My profile</a>
                </div>
            </div>
        </div>

        <form class="cart " action="cart.php">
            <input type="submit" value="Cart">
        </form>

    </header>

    <img class="main-image" src="../../img/IMG_4580-1702829-1920px-16x7 (1) copy.jpg" alt="">
    <div class="content-wrapper">
        <aside>
        </aside>
        <main>
            <div class="cart">
                <h2>Cart</h2>
                <?php if (empty($cartItems)) : ?>
                    <p class="empty-cart-message">Your shopping cart is empty!</p>
                <?php else : ?>
                    <table id="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item) : ?>
                                <tr>
                                    <td>
                                        <div class="product-container">
                                            <img src="../../<?= htmlspecialchars($item["image_url"]); ?>" alt="" width="100">
                                            <span class="product-name"><?= htmlspecialchars($item["name"]); ?></span>
                                        </div>
                                    </td>
                                    <td><input type="number" min="1" class="quantity-input" data-product-id="<?= $item["product_id"]; ?>" value="<?= htmlspecialchars($item["quantity"]); ?>"></td>
                                    <td><?= htmlspecialchars($item["price"]); ?> CZK</td>
                                    <td><button class="delete-item" data-product-id="<?= $item["product_id"]; ?>">Delete</button></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                    <div id="total-price">
                        Cena celkem:<?= $totalPrice; ?> Kč
                    </div>
                    <a href="checkout_page.php">
                        <button>Proceed to checkout</button>
                    </a>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <footer>
        <nav>
            <ul>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
        <p>&copy; 2023 Tea E-Shop. All rights reserved.</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="update.js"></script>
    <script src="main.js"></script>
    <script src="category_select.js"></script>


</body>

</html>