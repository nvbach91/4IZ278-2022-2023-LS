<?php
    $host = 'localhost';
    $db   = 'adaa08';
    $user = 'adaa08';
    $pass = 'dahp7Eidien4iokoop';
    $charset = 'utf8mb4';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-shop</title>
</head>
<body>
    <header>
        <h1>Vitaje v mojom E-shope!</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Domov</a></li>
            <li><a href="eshop.php">Eshop</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <main>
        <h2>O nás</h2>
        <p>Príklad.</p>

        <h2>Produkty</h2>

        <?php
            $query = 'SELECT product_id, name, price FROM products LIMIT 3';
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<div>\n";
                echo "<h3>" . $row['name'] . "</h3>\n";
                echo "<p>Price: " . $row['price'] . "</p>\n";
                echo "</div>\n";
            }
        ?>
    </main>

    <footer>
        <p>adaa08 Eshop</p>
    </footer>
</body>
</html>

<?php
    $conn->close();
?>
