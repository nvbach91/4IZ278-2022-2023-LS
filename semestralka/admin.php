<?php
include 'database.php';

session_start();



if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles/admin_style.css">
</head>
<body>
<div class="container">
    <h1>Admin Panel</h1>
    <a href="index.php"><button>Back to Homepage</button></a>
    <?php
    $stmt = $conn->prepare('SELECT * FROM products');
    $stmt->execute();
    $products = $stmt->fetchAll();
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo htmlspecialchars($product['product_id']); ?></td>
            <td><?php echo htmlspecialchars($product['product_name']); ?></td>
            <td><?php echo htmlspecialchars($product['price']); ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $product['product_id']; ?>">Edit</a>
                <a href="delete_product.php?id=<?php echo $product['product_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="add_product.php">Add new product</a>

</body>
</html>

