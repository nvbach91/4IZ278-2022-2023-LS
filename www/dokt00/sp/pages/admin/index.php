<?php
session_start();
if ($user['isAdmin']) {
    $_SESSION['isAdmin'] = true;
} else {
    $_SESSION['isAdmin'] = false;
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
                <li><a href="#">Green Tea</a></li>
                <li><a href="#">Black Tea</a></li>
                <li><a href="#">Herbal Tea</a></li>
                <li><a href="#">Fruit Tea</a></li>
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

    <img src="../../img/IMG_4580-1702829-1920px-16x7 (1) copy.jpg" alt="">
    <div class="content-wrapper">
        <aside>
            <h3>Categories</h3>
            <ul>
                <li><a href="#">Green Tea</a></li>
                <li><a href="#">Black Tea</a></li>
                <li><a href="#">Herbal Tea</a></li>
                <li><a href="#">Fruit Tea</a></li>
                <li><a href="#">Oolong Tea</a></li>
            </ul>
        </aside>
        <main>

            <?php include 'products.php'; ?>

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

    <script src="main.js"></script>
    <script src="../../search.js"></script>
</body>

</html>
