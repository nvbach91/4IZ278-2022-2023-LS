<?php
session_start();
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Tea E-Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="../../img/logo.png" alt="Tea E-Shop Logo" width="100">
            </a>
        </div>

        <nav>
            <ul>
                <li><a href="#" class="user-accounts">User accounts</a></li>
                <li><a href="#" class="orders-button">Orders</a></li>
            </ul>
        </nav>
        <div class="search">
            <form class="search-form">
                <input type="text" placeholder="Search" class="input-search" pattern="^[a-zA-Z0-9\s]*$" required>
                <button class="search-button" type="submit">Search</button>
            </form>
        </div>

        <div class="login">
            <div class="dropdown">
                <p>Welcome, <?php echo $_SESSION['username']; ?></p>
                <div class="dropdown-content">
                    <a href="order_history_page.php">Order history</a>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        </div>
    </header>

    <img class="main-image" src="../../img/IMG_4580-1702829-1920px-16x7 (1) copy.jpg" alt="">
    <div class="content-wrapper">
        <aside>
            <h3>Categories</h3>
            <ul>
                <li><a class="tea-category">Zelený čaj</a></li>
                <li><a class="tea-category">Černý čaj</a></li>
                <li><a class="tea-category">Bylinný čaj</a></li>
                <li><a class="tea-category">Ovocný čaj</a></li>
                <li><a class="tea-category">čaj Oolong</a></li>
            </ul>
        </aside>
        <main>

            <?php include 'admin_products.php'; ?>

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

    <script src="../../search.js"></script>
    <script src="edit_product.js"></script>
    <script src="delete_product.js"></script>
    <script src="add_product.js"></script>  
    <script src="../../category_select.js"></script>
    <script src="users.js"></script>
    <script src="edit_user.js"></script>
    <script src="delete_user.js"></script>
    <script src="orders.js"></script>



</body>

</html>
