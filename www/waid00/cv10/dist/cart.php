<?php
session_start();
include_once('database.php');
$username = $_SESSION['login'];

$query = "SELECT o.*, p.name AS product_name, c.name AS category_name, u.name AS user_name
          FROM orders o
          LEFT JOIN products p ON o.product_id = p.product_id
          LEFT JOIN categories c ON p.category_id = c.category_id
          LEFT JOIN users u ON o.user_id = u.user_id
          WHERE u.name = :username";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['order_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $order_id = $_GET['order_id'];
    $deleteQuery = "DELETE FROM orders WHERE order_id = :order_id";
    $deleteStmt = $pdo->prepare($deleteQuery);
    $deleteStmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $deleteStmt->execute();
    header('Location: cart.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            color: #ff0000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($results as $row) { ?>
            <tr>
                <td><?php echo $row['product_name']; ?></td>
                <td>
                    <a href="?order_id=<?php echo $row['order_id']; ?>&action=delete">x</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="index.php">main</a>
</body>

</html>