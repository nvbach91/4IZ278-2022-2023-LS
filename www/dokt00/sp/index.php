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
            <img src="data:image/png;base64,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"
                alt="Tea E-Shop Logo" width="100">
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
            <input type="text" placeholder="Search" class="input-search">
            <button class="search-button">Search</button>
        </div>
        <div class="login">
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" class="input-login">
                <a onclick="openModal()" class="register-link">Don't have an account? Register here!</a>
                <input type="password" name="password" placeholder="Password" class="input-login">
                <button type="submit">Login</button>
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
    <script src="search.js"></script>
</body>

</html>