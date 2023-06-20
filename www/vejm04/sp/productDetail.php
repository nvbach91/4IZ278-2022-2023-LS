<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Detail</title>
    <link rel="stylesheet" type="text/css" href="./styles/styles.css">
    <link rel="stylesheet" type="text/css" href="./styles/product-detail.css">
</head>
<body>
    <?php
    require_once 'config.php';
    require_once 'header.php';

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        try {
            $query = "SELECT * FROM products WHERE id = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$productId]);
            $product = $statement->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $productName = $product['name'];
                $productDescription = $product['description'];
                $productPrice = $product['price'];
                $productImage = $product['image'];

                echo "<div class='product-detail-container'>";
                echo "<div class='product-detail'>";
                echo "<img src='$productImage' alt='$productName'>";
                echo "<h3>$productName</h3>";
                echo "<p>$productDescription</p>";
                echo "<p>Price: $productPrice</p>";

                echo "<form action='cart.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='$productId'>";
                echo "<input type='hidden' name='quantity' value='1'>";
                echo "<input type='submit' name='add_to_cart' value='Add to Cart' class='btn'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "<p>Product not found.</p>";
            }
        } catch (PDOException $e) {
            die("Error executing the query: " . $e->getMessage());
        }
    } else {
        echo "<p>Invalid product ID.</p>";
    }
    ?>
</body>
</html>