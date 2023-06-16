<?php
    session_start();
    require_once 'auth.php';
    requireLogin();
    require_once 'dbconfig.php';


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
?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>

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
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['amount']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

<?php require __DIR__ . '/footer.php'; ?>
