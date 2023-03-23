<?php

require_once 'UsersDB.php';
require_once 'ProductsDB.php';
require_once 'OrdersDB.php';

$usersDB = new UsersDB(__DIR__ . '/data/', '.txt', ';');

// Testovací uživatelé
$testUsers = [
    [
        'id' => 1,
        'username' => 'Petr_Novak',
        'email' => 'petr.novak@email.cz'
    ],
    [
        'id' => 2,
        'username' => 'Jana_Svobodova',
        'email' => 'jana.svobodova@email.cz'
    ]
];

foreach ($testUsers as $user) {
    $usersDB->create($user);
}

$productsDB = new ProductsDB(__DIR__ . '/data/', '.txt', ';');

// Testovací produkty
$testProducts = [
    [
        'id' => 1,
        'name' => 'Rohlik',
        'price' => 2.50
    ],
    [
        'id' => 2,
        'name' => 'Houska',
        'price' => 3.00
    ]
];

foreach ($testProducts as $product) {
    $productsDB->create($product);
}

$ordersDB = new OrdersDB(__DIR__ . '/data/', '.txt', ';');

// Testovací objednávky
$testOrders = [
    [
        'id' => 1,
        'user_id' => 1,
        'product_id' => 1,
        'quantity' => 10
    ],
    [
        'id' => 2,
        'user_id' => 2,
        'product_id' => 2,
        'quantity' => 5
    ]
];

foreach ($testOrders as $order) {
    $ordersDB->create($order);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATABASE</title>
</head>

<body>
    <h1>Database interface</h1>

    <h2>Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php foreach ($testUsers as $user) : ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        <?php foreach ($testProducts as $product) : ?>
            <tr>
                <td><?= htmlspecialchars($product['id']) ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($testOrders as $order) : ?>
            <tr>
                <td><?= htmlspecialchars($order['id']) ?></td>
                <td><?= htmlspecialchars($order['user_id']) ?></td>
                <td><?= htmlspecialchars($order['product_id']) ?></td>
                <td><?= htmlspecialchars($order['quantity']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>