<?php session_start(); ?>

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
            <a href="logged_in.php">
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
            <input type="text" placeholder="Search" class="input-search">
            <button action="cart.php">Search</button>
        </div>

        <div class="login">
            <div class="dropdown">
                <p>Welcome, <?php echo $_SESSION['username']; ?></p>
                <div class="dropdown-content">
                    <a href="order_history.php">Order history</a>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        </div>

        <form class="cart " action="cart.php">
            <input type="submit" value="Cart">
        </form>

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

    <div id="register-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="register-form" action="register.php" method="POST" onsubmit="event.preventDefault(); registerUser();">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name">

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name">

                <label for="phone">Phone:</label>
                <input type="tel" name="phone" id="phone">

                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <script src="main.js"></script>
</body>

</html>