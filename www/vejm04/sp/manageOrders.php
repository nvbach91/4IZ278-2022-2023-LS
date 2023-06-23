<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

function deleteOrder($orderId) {
    global $pdo;
    try {
        $query = "DELETE FROM orders WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$orderId]);
    } catch (PDOException $e) {
        die("Error executing the query: " . $e->getMessage());
    }
}

try {
    $query = "SELECT * FROM orders ORDER BY id DESC ";
    $statement = $pdo->query($query);
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing the query: " . $e->getMessage());
}

if (isset($_POST['delete'])) {
    $orderId = $_POST['order_id'];
    deleteOrder($orderId);
    header("Location: manageOrders.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" type="text/css" href="./styles/manage.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h1>Manage Orders</h1>

    <section>
        <?php if (count($orders) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <?php
                                $userQuery = "SELECT email FROM users WHERE id = ?";
                                $userStatement = $pdo->prepare($userQuery);
                                $userStatement->execute([$order['user_id']]);
                                $user = $userStatement->fetch(PDO::FETCH_ASSOC);
                                $email = $user ? $user['email'] : 'N/A';
                                ?>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $order['total']; ?></td>
                            <td><?php echo $order['date']; ?></td>
                            <td><?php echo $order['status']; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <button type="submit" name="delete" class="btn">Delete</button>
                                </form>
                            </td>
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
