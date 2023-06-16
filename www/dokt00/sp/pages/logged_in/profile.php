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
                    <a href="profile.php">My profile</a>
                </div>
            </div>
        </div>

        <form class="cart " action="cart.php">
            <input type="submit" value="Cart">
        </form>

    </header>

    <div class="content-wrapper">
        <aside>
            
        </aside>
        <main>

            <?php include 'user_info.php'; ?>

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
    <script src="search.js"></script>
    <script src="add_to_cart.js"></script>

</body>

</html>