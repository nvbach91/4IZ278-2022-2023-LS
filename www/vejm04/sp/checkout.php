<?php
session_start();
require_once 'config.php';
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
?>

<!DOCTYPE html>
<html lang="en">
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
                                <td><?= $product['name']; ?></td>
                                <td><?= $quantity; ?></td>
                                <td><?= $product['price'] * $quantity; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total Price:</td>
                            <td><?= $totalPrice; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="shipping-options">
                <h2>Shipping Options</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Shipping Method</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $selectedShippingId = isset($_POST['selected_shipping']) ? $_POST['selected_shipping'] : '';
                        $selectedShippingId = htmlspecialchars($selectedShippingId);
                        $shippingQuery = "SELECT * FROM shippings WHERE id = :shippingId";
                        $shippingStatement = $pdo->prepare($shippingQuery);
                        $shippingStatement->execute(['shippingId' => $selectedShippingId]);
                        $selectedShipping = $shippingStatement->fetch(PDO::FETCH_ASSOC);

                        if ($selectedShipping) {
                            $shippingName = $selectedShipping['name'];
                            $shippingPrice = $selectedShipping['price'];
                        ?>
                            <tr>
                                <td><?= $shippingName; ?></td>
                                <td><?= $shippingPrice; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="payment-options">
                <h2>Payment Options</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Payment Method</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $selectedPaymentId = isset($_POST['selected_payment']) ? $_POST['selected_payment'] : '';
                        $selectedPaymentId = htmlspecialchars($selectedPaymentId);
                        $paymentQuery = "SELECT * FROM payments WHERE id = :paymentId";
                        $paymentStatement = $pdo->prepare($paymentQuery);
                        $paymentStatement->execute(['paymentId' => $selectedPaymentId]);
                        $selectedPayment = $paymentStatement->fetch(PDO::FETCH_ASSOC);

                        if ($selectedPayment) {
                            $paymentName = $selectedPayment['name'];
                            $paymentPrice = $selectedPayment['price'];
                        ?>
                            <tr>
                                <td><?= $paymentName; ?></td>
                                <td><?= $paymentPrice; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="personal-info">
                <h2>Personal Information</h2>
                <?php
                if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['zip_code']) && isset($_POST['email'])) {
                    $firstName = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
                    $lastName = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
                    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
                    $city = isset($_POST['city']) ? trim($_POST['city']) : '';
                    $zipCode = isset($_POST['zip_code']) ? $_POST['zip_code'] : '';
                    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

                    $firstName = htmlspecialchars($firstName);
                    $lastName = htmlspecialchars($lastName);
                    $address = htmlspecialchars($address);
                    $city = htmlspecialchars($city);
                    $zipCode = htmlspecialchars($zipCode);
                    $email = htmlspecialchars($email);
                ?>
                    <p><strong>First Name:</strong> <?= $firstName; ?></p>
                    <p><strong>Last Name:</strong> <?= $lastName; ?></p>
                    <p><strong>Address:</strong> <?= $address; ?></p>
                    <p><strong>City:</strong> <?= $city; ?></p>
                    <p><strong>Zip Code:</strong> <?= $zipCode; ?></p>
                    <p><strong>Email:</strong> <?= $email; ?></p>
                <?php } ?>
            </div>
            <div class="send-order">
                <form action="sendOrder.php" method="post">
                    <?php foreach ($cartItems as $cartItem): ?>
                        <input type="hidden" name="product[]" value="<?= $cartItem['product_id']; ?>">
                        <input type="hidden" name="quantity[]" value="<?= $cartItem['quantity']; ?>">
                    <?php endforeach; ?>
                    <input type="hidden" name="total_price" value="<?= $totalPrice; ?>">

                    <input type="hidden" name="first_name" value="<?= $firstName; ?>">
                    <input type="hidden" name="last_name" value="<?= $lastName; ?>">
                    <input type="hidden" name="address" value="<?= $address; ?>">
                    <input type="hidden" name="city" value="<?= $city; ?>">
                    <input type="hidden" name="zip_code" value="<?= $zipCode; ?>">
                    <input type="hidden" name="email" value="<?= $email; ?>">

                    <input type="hidden" name="selected_shipping" value="<?= $selectedShippingId; ?>">
                    <input type="hidden" name="selected_payment" value="<?= $selectedPaymentId; ?>">

                    <div class="send-order"><button type="submit">Send Order</button></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
