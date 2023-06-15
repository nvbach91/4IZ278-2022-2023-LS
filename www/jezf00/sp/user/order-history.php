<?php
    session_start();
    require_once '../auth.php';
    requireLogin();
    require_once '../dbconfig.php';

    $email = $_SESSION['user']['email'];

    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
        ';dbname=' . DB_NAME .
        ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $stmt = $pdo->prepare("SELECT * FROM sp_order WHERE email = ? ORDER BY date DESC");
    $stmt->execute([$email]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require '../header.php'; ?>

<body class="container">
    <?php require '../navbar.php'; ?>

    <h3 class="mb-4">Order History</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Price</th>
                <th>Date & time</th>
                <th>Payment Method</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['price']; ?></td>
                    <td><?php echo $order['date']; ?></td>
                    <td><?php echo $order['payment_method']; ?></td>
                    <td>
                         <form action="order-detail.php" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <button type="submit" class="btn btn-link">View order details</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

<?php require '../footer.php'; ?>
