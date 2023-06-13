<?php
include 'database.php';

session_start();

// chekne usera či je admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get prducts
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; 

    // vloží novy produkt do databaze
    $stmt = $conn->prepare('INSERT INTO products (product_name, description, price, image) VALUES (?, ?, ?, ?)');
    $stmt->execute([$productName, $description, $price, $image]);

    
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
    <title>Add Product</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Add Product</h1>

    <form action="add_product.php" method="POST">
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" step="0.01"><br>
        <label for="image">Image Filename:</label><br>
        <input type="text" id="image" name="image"><br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
