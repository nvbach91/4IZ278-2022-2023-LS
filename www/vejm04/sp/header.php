<header>
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <div class="container">
        <a href="index.php" class="nav-button nav-home">Home</a>
        <nav>
            <?php
            session_start();
            if (!isset($_SESSION['user_id'])) {
                echo '
                    <a href="registration.php" class="nav-button nav-btn">Register</a>
                    <a href="login.php" class="nav-button nav-btn">Login</a>
                ';
            } else {
                echo '
                    <a href="account.php" class="nav-button nav-btn">Account</a>
                    <a href="logout.php" class="nav-button nav-btn">Log out</a>
                ';
            }
            echo '<a href="cart.php" class="nav-button nav-btn">Cart</a>';
            ?>
        </nav>
    </div>
</header>