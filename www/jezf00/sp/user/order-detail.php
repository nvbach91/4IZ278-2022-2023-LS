<?php
    session_start();
    require_once '../auth.php';
    requireLogin();
    require_once '../dbconfig.php';


    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
        ';dbname=' . DB_NAME .
        ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $orderID = $_POST['order_id'];


    $stmt = $pdo->prepare("
        SELECT sp_order_table.order_id, sp_order_table.good_id, sp_order_table.amount, sp_products.name, sp_products.price
        FROM sp_order_table
        JOIN sp_products ON sp_order_table.good_id = sp_products.good_id
        WHERE sp_order_table.order_id = ?
    ");
    $stmt->execute([$orderID]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPrice = 0;
    foreach ($items as $item) {
        $totalPrice += $item['price'] * $item['amount'];
    }
?>

<?php require '../header.php'; ?>

<body class="container">
    <?php require '../navbar.php'; ?>

    <h3 class="mb-4">Order Details</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><a href="../product-detail.php?good_id=<?php echo $item['good_id'] ?>"><?php echo $item['name']; ?></td>
                    <td><?php echo $item['amount']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right"><strong>Total:</strong></td>
                <td><?php echo $totalPrice; ?></td>
            </tr>
        </tfoot>
    </table>

</body>

<?php require '../footer.php'; ?>
