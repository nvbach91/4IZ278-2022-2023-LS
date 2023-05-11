<?php
  
    $username = '';
    $password = 'í';
    $connection_string = '';


    $conn = oci_connect($username, $password, $connection_string);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My E-shop</title>
</head>
<body>
    <header>
        <h1>Welcome to My E-shop!</h1>
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
            $stid = oci_parse($conn, $query);
            oci_execute($stid);

            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                echo "<div>\n";
                echo "<h3>" . $row['NAME'] . "</h3>\n";
                echo "<p>Price: " . $row['PRICE'] . "</p>\n";
                echo "</div>\n";
            }

            oci_free_statement($stid);
        ?>
    </main>

    <footer>
        <p>adaa08 Eshop</p>
    </footer>
</body>
</html>

<?php
    // Close the connection
    oci_close($conn);
?>
