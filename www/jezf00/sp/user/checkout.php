<?php
session_start();
require_once '../auth.php';
requireLogin();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {

    header("Location: cart.php");
    exit();
}

require_once '../dbconfig.php';
$pdo = new PDO(
    'mysql:host=' . DB_HOST .
    ';dbname=' . DB_NAME .
    ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

$cart = $_SESSION['cart'];

function fetchCartItems($pdo, $cart)
{
    $ids = implode(',', array_values($cart));
    $statement = $pdo->prepare("SELECT * FROM sp_products WHERE good_id IN ($ids)");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

$records = fetchCartItems($pdo, $cart);
$totalPrice = $_POST['totalPrice'];


$userEmail = $_SESSION['user']['email'];
$statement = $pdo->prepare("SELECT name, state, postalCode, adress FROM sp_users WHERE email = :email");
$statement->execute([':email' => $userEmail]);
$user = $statement->fetch(PDO::FETCH_ASSOC);
?>

<?php require '../header.php'; ?>

<body class="container">
    <?php require '../navbar.php'; ?>

    <h3 class="mb-4">Checkout</h3>

    <div class="alert alert-info" role="alert">
        Your current delivery information:
        <ul>
            <li>Name: <?php echo $user['name']; ?></li>
            <li>State: <?php echo $user['state']; ?></li>
            <li>Postal Code: <?php echo $user['postalCode']; ?></li>
            <li>Address: <?php echo $user['adress']; ?></li>
        </ul>
        <a href="profile.php" class="btn btn-primary">Edit</a>
    </div>
    <form method="post" action="../order.php">
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $item) : ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo isset($cart[$item['good_id']]) ? $cart[$item['good_id']] + 1 : 1; ?></td>
                        <td><?php echo $item['price']; ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                    <td><?php echo $totalPrice; ?> €</td>
                </tr>
            </tfoot>
        </table>

        <div class="form-group">
            <label for="paymentMethod">Payment Method:</label>
            <select class="form-control" id="paymentMethod" name="paymentMethod">
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="cash">Cash</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deliveryMethod">Delivery Method:</label>
            <select class="form-control" id="deliveryMethod" name="deliveryMethod">
                <option value="standard">Standard Delivery</option>
                <option value="express">Express Delivery</option>
            </select>
        </div>

        <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Place Order</button>
        </div>
    </form>

</body>

<?php require '../footer.php'; ?>
