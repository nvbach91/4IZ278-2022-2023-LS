<?php
session_start();

$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

//connection to db
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT `order`.order_id, orderitem.quantity, product.price, product.name, product.image_url 
        FROM `order` 
        JOIN orderitem ON `order`.order_id = orderitem.order_id 
        JOIN product ON orderitem.product_id = product.product_id 
        WHERE `order`.user_id = ? AND `order`.status = 'pending'";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();

$result = $stmt->get_result();
$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

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
            <div class="cart">
                <h2>Your Shopping Cart</h2>
                <table id="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item) : ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($item["image_url"]); ?>" alt="<?= htmlspecialchars($item["name"]); ?>" width="100"></td>
                                <td><?= htmlspecialchars($item["name"]); ?></td>
                                <td><?= htmlspecialchars($item["quantity"]); ?></td>
                                <td><?= htmlspecialchars($item["price"]); ?> CZK</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div id="total-price">
                    Cena celkem:<?= $totalPrice; ?> Kč
                </div>
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
</body>

</html>
