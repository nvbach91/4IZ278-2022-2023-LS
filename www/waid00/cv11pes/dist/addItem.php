<?php
session_start();
include('database.php');
if(!isset($_SESSION['login']) && $_SESSION['privilege'] == 0){
    header('Location: login.php');
}



if (isset($_POST['submit'])) {
    if (!empty($_POST['product_name']) && !empty($_POST['price']) && !empty($_POST['category_id'])) {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $image = 'https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png';

        try {
            $stmt = $pdo->prepare("SELECT MAX(product_id) AS max_product_id FROM `products`");
            $stmt->execute();
            $result = $stmt->fetch();
            $max_product_id = $result['max_product_id'];
            $new_product_id = $max_product_id + 1;
            $stmt = $pdo->prepare("INSERT INTO `products` (`product_id`, `name`, `price`, `special`, `category_id`, `image`) VALUES (?, ?, ?, 0, ?, ?)");
            $stmt->execute([$new_product_id, $product_name, $price, $category_id, $image]);

            header('Location: index.php');
        } catch (Exception $e) {
            $error = "Failed to add product: " . $e->getMessage();
        }
    } else {
        $error = "Please fill all the fields.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <h1>Add Product</h1>
    <form method="post">
        <label for="product_name">Product Name</label>
        <input type="text" id="product_name" name='product_name' placeholder="Product Name..."><br><br>
        <label for="price">Price</label>
        <input type="number" id="price" name='price' placeholder="Price..."><br><br>
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id">
            <?php
            $stmt = $pdo->query("SELECT * FROM `categories`");
            $categories = $stmt->fetchAll();
            foreach ($categories as $category) {
                echo "<option value='" . htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') . "</option>";
            }
            ?>
        </select><br><br>
        <input type="submit" name='submit' value="Add Product">
        <p style="color: red;"><?php echo isset($error) ? $error : ''; ?></p>
    </form>
    <a href="index.php">Back to Catalog</a>
</body>

</html>