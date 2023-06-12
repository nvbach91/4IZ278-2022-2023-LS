<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tea E-Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="Tea E-Shop Logo" width="100">
            </a>
        </div>
        <nav>
            <ul>
                <li><a class="category" href="#">Green Tea</a></li>
                <li><a class="category" href="#">Black Tea</a></li>
                <li><a class="category" href="#">Herbal Tea</a></li>
                <li><a class="category" href="#">Fruit Tea</a></li>
            </ul>
        </nav>
        <div class="search">
            <form class="search-form">
                <input type="text" placeholder="Search" class="input-search" pattern="^[a-zA-Z0-9\s]*$" required>
                <button class="search-button" type="submit">Search</button>
            </form>
        </div>
        <div class="login">
            <form id="login-form" method="POST">
                <div class="inputs-wrapper">
                    <input type="text" name="username" placeholder="Username" class="input-login" pattern="^[a-zA-Z0-9]*$" required>
                    <input type="password" name="password" placeholder="Password" class="input-login" required>
                    <button type="submit">Login</button>
                </div>
                <a onclick="openModal()" class="register-link">Don't have an account? Register here!</a>
                <p id="login-error"></p>
            </form>
        </div>

        <div class="cart">
            <button class="cart-button">Cart</button>
        </div>
    </header>

    <img src="img/IMG_4580-1702829-1920px-16x7 (1).jpg" alt="">
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
            <?php
            if (!empty($_SESSION['alertMessages'])) : ?>
                <div class="alert <?php echo $_SESSION['alertType']; ?>">
                    <?php foreach ($_SESSION['alertMessages'] as $message) : ?>
                        <p><?php echo $message; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php
                $_SESSION['alertMessages'] = [];
            endif;
            ?>
            <form id="register-form" action="register.php" method="POST" novalidate>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" pattern="^[a-zA-Z0-9]*$" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" pattern="^[a-zA-ZěščřžýáíéĚŠČŘŽÝÁÍÉ]*$">

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" pattern="^[a-zA-ZěščřžýáíéĚŠČŘŽÝÁÍÉ]*$">

                <label for="phone">Phone:</label>
                <input type="tel" name="phone" id="phone">

                <button type="submit">Register</button>
            </form>

        </div>
    </div>

    <script src="main.js"></script>
    <script src="search.js"></script>
    <script src="login.js"></script>
</body>

</html>