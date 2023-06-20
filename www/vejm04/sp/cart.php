<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="./styles/common.css">
    <link rel="stylesheet" type="text/css" href="./styles/cart.css">
</head>
<body>
    <?php
    session_start();
    require_once 'config.php';
    require_once 'header.php';

    $firstName = '';
    $lastName = '';
    $address ='';
    $city = '';
    $zipCode = '';
    $email = '';

    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }
        
        header("Location: cart.php");
        exit();
    }

    if (empty($_SESSION['cart'])) {
        echo "<p class='empty-cart-message'>Your cart is empty.</p>";
    } else {
        $productIds = array_keys($_SESSION['cart']);
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));

        try {
            $query = "SELECT * FROM products WHERE id IN ($placeholders)";
            $statement = $pdo->prepare($query);
            $statement->execute($productIds);
            $cartProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Cart</h2>";
            echo "<div class='cart-products'>";
            foreach ($cartProducts as $product) {
                $productId = $product['id'];
                $productName = $product['name'];
                $productPrice = $product['price'];
                $productImage = $product['image'];
                $productQuantity = $_SESSION['cart'][$productId];

                if ($productQuantity === 0) {
                    continue;
                }

                echo "<div class='cart-product'>";
                echo "<a href='productDetail.php?id=$productId'><div class='product-image'><img src='$productImage' alt='$productName'></div></a>";
                echo "<div class='product-details'>";
                echo "<a href='productDetail.php?id=$productId'><h3>$productName</h3></a>";
                if ($productQuantity > 1) {
                    $totalProductPrice = $productPrice * $productQuantity;
                    echo "<p>Total Price: $totalProductPrice</p>";
                } else {
                    echo "<p>Price: $productPrice</p>";
                }
                echo "<p>Quantity: $productQuantity</p>";
                echo "</div>";
                echo "<div class='remove-button'>";
                echo "<form action='removeFromCart.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='$productId'>";
                echo "<input type='submit' value='Remove from Cart' class='btn'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";

            echo "<h2>Personal Information</h2>";
            echo "<div class='checkout-container'>";
            echo "<form action='checkout.php' method='post'>";

            if(isset($_SESSION['user_id'])) {
                try {
                    $query = "SELECT * FROM users WHERE id = ?";
                    $statement = $pdo->prepare($query);
                    $statement->execute([$_SESSION['user_id']]);
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    $firstName = $result['first_name'];
                    $lastName = $result['last_name'];
                    $address = $result['address'];
                    $city = $result['city'];
                    $zipCode = $result['zip'];
                    $email = $result['email'];
                } catch (PDOException $e) {
                    die("Error executing the query: " . $e->getMessage());
                }
            }
            
            echo "<div class='personal-info-form'>";
            echo "<label for='first_name'>First Name:</label>";
            echo "<input type='text' name='first_name' id='first_name' maxlength='20' value='" . $firstName . "' required>";
            echo "<label for='last_name'>Last Name:</label>";
            echo "<input type='text' name='last_name' id='last_name' maxlength='20' value='" . $lastName . "' required>";
            echo "<label for='address'>Address:</label>";
            echo "<input type='text' name='address' id='address' maxlength='50' value='" . $address . "' required>";
            echo "<label for='city'>City:</label>";
            echo "<input type='text' name='city' id='city' maxlength='20' value='" . $city . "' required>";
            echo "<label for='zip_code'>ZIP Code:</label>";
            echo "<input type='text' name='zip_code' id='zip_code' pattern='[0-9]{5}' value='" . $zipCode . "' required>";
            echo "<label for='email'>Email:</label>";
            echo "<input type='email' name='email' id='email' value='" . $email . "' required>";

            foreach ($cartProducts as $product) {
                $productId = $product['id'];
                $productQuantity = $_SESSION['cart'][$productId];
                if ($productQuantity > 0) {
                    echo "<input type='hidden' name='product[]' value='$productId'>";
                    echo "<input type='hidden' name='quantity[]' value='$productQuantity'>";
                }
            }

            echo "<input type='submit' value='Checkout' class='btn checkout-btn'>";
            echo "</div>";

            echo "</form>";
            echo "</div>";
            
        } catch (PDOException $e) {
            die("Error executing the query: " . $e->getMessage());
        }
    }
    ?>
    </body>
</html>