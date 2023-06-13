<?php
include 'database.php';

session_start();


if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}


$product_id = $_GET['id'];


$stmt = $conn->prepare('SELECT * FROM products WHERE product_id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch();

// zisti či sa edit submitol
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    
    $stmt = $conn->prepare('UPDATE products SET product_name = ?, price = ? WHERE product_id = ?');
    $stmt->execute([$product_name, $price, $product_id]);

    
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Edit Product</h1>

    <form method="POST">
        <label for="product_name">Product Name</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>">

        <label for="price">Price</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">

        <button type="submit">Save Changes</button>
    </form>

</body>
</html>
