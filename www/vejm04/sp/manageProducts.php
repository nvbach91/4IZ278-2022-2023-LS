<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

function deleteProduct($productId) {
    global $pdo;
    try {
        $query = "DELETE FROM products WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$productId]);
    } catch (PDOException $e) {
        die("Error executing the query: " . $e->getMessage());
    }
}

try {
    $query = "SELECT * FROM products";
    $statement = $pdo->query($query);
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing the query: " . $e->getMessage());
}

if (isset($_POST['delete'])) {
    $productId = $_POST['product_id'];
    deleteProduct($productId);
    header("Location: manageProducts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" type="text/css" href="./styles/manage.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h1>Manage Products</h1>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="delete" class="btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>
