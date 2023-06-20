<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    $query = "SELECT * FROM users WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_SESSION['user_id']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing the query: " . $e->getMessage());
}

try {
    $query = "SELECT * FROM orders WHERE user_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_SESSION['user_id']]);
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing the query: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account</title>
    <link rel="stylesheet" type="text/css" href="./styles/account.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h1>Account</h1>

    <section>
        <h2>Personal Information</h2>
        <p><strong>First Name:</strong> <?php echo $user['first_name']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $user['last_name']; ?></p>
        <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
        <p><strong>City:</strong> <?php echo $user['city']; ?></p>
        <p><strong>ZIP Code:</strong> <?php echo $user['zip']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <a href="editUser.php" class="btn">Edit</a>
    </section>

    <section>
        <h2>Orders</h2>
        <?php if (count($orders) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['total']; ?></td>
                            <td><?php echo $order['date']; ?></td>
                            <td><?php echo $order['status']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No orders found.</p>
        <?php } ?>
    </section>
</body>
</html>