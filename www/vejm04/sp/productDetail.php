<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Detail</title>
    <link rel="stylesheet" type="text/css" href="./styles/styles.css">
    <link rel="stylesheet" type="text/css" href="./styles/product-detail.css">
</head>
<body>
    <?php
    session_start();
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
                ?>

                <div class="product-detail-container">
                    <div class="product-detail">
                        <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
                        <h3><?php echo $productName; ?></h3>
                        <p><?php echo $productDescription; ?></p>
                        <p>Price: <?php echo $productPrice; ?></p>

                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn">
                        </form>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <p>Product not found.</p>
                <?php
            }
        } catch (PDOException $e) {
            die("Error executing the query: " . $e->getMessage());
        }
    } else {
        ?>
        <p>Invalid product ID.</p>
        <?php
    }
    ?>
</body>
</html>
