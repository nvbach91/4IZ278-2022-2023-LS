<?php

include '../config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../login.php');
}

if (isset($_POST['add_to_cart'])) {
    $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
    $product_author = mysqli_real_escape_string($connection, $_POST['product_author']);
    $product_price = $_POST['product_price'];
    $product_image = mysqli_real_escape_string($connection, $_POST['product_image']);
    $product_quantity = $_POST['product_quantity'];

    $query = "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'";
    $check_cart_numbers = mysqli_query($connection, $query) or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Already added to cart';
    } else {
        $query = "INSERT INTO `cart`(user_id,name,price,quantity, image, author) 
        VALUES ('$user_id','$product_name', '$product_price','$product_quantity','$product_image','$product_author')";
        mysqli_query($connection, $query) or die('query failed');
        $message[] = 'Book was added to cart';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <!-- <?php include 'shop.php'; ?> -->

    <div class="heading">
        <h3>Search page</h3>
        <p><a href="./home.php">home</a> / search</p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="search book by it's name or author" class="box">
            <input type="submit" name="submit" value="search" class="button">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">
        <div class="box-container">
            <div class="product_wrapper">
                <?php
                if (isset($_POST['submit'])) {
                    $search_item = $_POST['search'];

                    $query = "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%' OR author LIKE '%{$search_item}%'";
                    $select_products = mysqli_query($connection, $query) or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {

                ?>
                            <form action="" method="post" class="box">
                                <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_products['image']) ?>">
                                <div class="name"><?php echo htmlspecialchars($fetch_products['name']) ?></div>
                                <div class="author"><?php echo htmlspecialchars($fetch_products['author']) ?></div>
                                <div class="genre"><?php echo htmlspecialchars($fetch_products['genre']) ?></div>
                                <div class="price">$<?php echo htmlspecialchars($fetch_products['price']) ?>/-</div>
                                <input type="number" min="1" name="product_quantity" value="1" class="quantity">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']) ?>">
                                <input type="hidden" name="product_author" value="<?php echo htmlspecialchars($fetch_products['author']) ?>">
                                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']) ?>">
                                <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']) ?>">
                                <input type="submit" value="add to cart" name="add_to_cart" class="button">
                            </form>
                <?php
                        }
                    } else {
                        echo '<p class="empty">No results found</p>';
                    }
                } else {
                    echo '<p class="empty">Search something!</p>';
                }
                ?>
            </div>
        </div>
    </section>



    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>