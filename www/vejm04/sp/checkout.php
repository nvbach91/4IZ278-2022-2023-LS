<?php
require_once 'config.php';
session_start();
$cartItems = [];

if (isset($_POST['product']) && isset($_POST['quantity'])) {
    $productIds = $_POST['product'];
    $quantities = $_POST['quantity'];

    for ($i = 0; $i < count($productIds); $i++) {
        $productId = $productIds[$i];
        $quantity = $quantities[$i];

        $cartItems[] = [
            'product_id' => $productId,
            'quantity' => $quantity
        ];
    }
}

$totalPrice = 0;
foreach ($cartItems as $cartItem) {
    $productId = $cartItem['product_id'];
    $quantity = $cartItem['quantity'];

    $queryProduct = "SELECT * FROM products WHERE id = :productId";
    $stmtProduct = $pdo->prepare($queryProduct);
    $stmtProduct->execute(['productId' => $productId]);
    $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);

    if ($product !== false) {
        $itemPrice = $product['price'] * $quantity;
        $totalPrice += $itemPrice;
    }
}

$_SESSION['cart'] = [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="./styles/checkout.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Checkout</h1>
    <div class="container" style="justify-content: center;">
        <div class="checkout-summary">
            <div class="order-summary">
                <h2>Order Summary</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $cartItem): ?>
                            <?php
                            $productId = $cartItem['product_id'];
                            $quantity = $cartItem['quantity'];

                            $queryProduct = "SELECT * FROM products WHERE id = :productId";
                            $stmtProduct = $pdo->prepare($queryProduct);
                            $stmtProduct->execute(['productId' => $productId]);
                            $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $product['price'] * $quantity; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total Price:</td>
                            <td><?php echo $totalPrice; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="personal-info">
                <h2>Personal Information</h2>
                <?php
                if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['zip_code']) && isset($_POST['email'])) {
                    $firstName = $_POST['first_name'];
                    $lastName = $_POST['last_name'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $zipCode = $_POST['zip_code'];
                    $email = $_POST['email'];
                
                    echo "<p><strong>First Name:</strong> $firstName</p>";
                    echo "<p><strong>Last Name:</strong> $lastName</p>";
                    echo "<p><strong>Address:</strong> $address</p>";
                    echo "<p><strong>City:</strong> $city</p>";
                    echo "<p><strong>Zip Code:</strong> $zipCode</p>";
                    echo "<p><strong>Email:</strong> $email</p>";
                }
                ?>
                </div>
                <div class="thank-you">
                    <p>Thank you for your order!</p>
                </div>
            </div>
        </div>
    </body>
</html>